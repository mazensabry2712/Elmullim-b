<?php

namespace App\Http\Controllers\Api\Student;

use App\Enums\PaymentStatusEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Main\RatingRequest;
use App\Http\Requests\Api\Student\PaymentInitiateRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonReource;
use App\Http\Resources\RatingResource;
use App\Http\Services\PaymobService;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public $student;

    public function __construct()
    {
        $this->student = auth('student')->user();
    }

    public function rateTeacher(RatingRequest $request, $teacher_id)
    {
        $request->validated();
        $teacher = Teacher::find($teacher_id);

        if (!$teacher || !is_numeric($teacher_id)) {
            return failResponse('not found teacher');
        }

        $this->student->teacherRatings()->attach($teacher_id, [
            'rate' => $request->rate,
            'description' => $request->description,
        ]);

        return successResponse('success add rate');
    }

    public function allGivenRatings()
    {
        $ratings = Teacher::all()->map(function ($item) {
            return $item->studentRatingsAboutMe()->where('students.id', '=', $this->student->id)->get();
        })->flatten()->sortByDesc('pivot.created_at');

        return successResponse(data: RatingResource::collection($ratings));
    }

    public function allReceivedRatings()
    {
        $ratings = $this->student->teacherRatingsAboutMe()->orderByPivot('created_at', 'desc')->get();

        return successResponse(data: RatingResource::collection($ratings));
    }

    public function intiatePayment(PaymentInitiateRequest $request)
    {
        $validated = $request->validated();
        $orderable = $validated['orderable_type'] === 'lessons'
            ? Lesson::query()->find($validated['orderable_id'])
            : Course::query()->find($validated['orderable_id']);

        if (!$orderable) {
            return failResponse('not found resource');
        }

        $price = (float) $orderable->price;
        if ($price <= 0) {
            return failResponse('this resource is free');
        }

        $enrolled = $validated['orderable_type'] === 'lessons'
            ? $this->student->enrollingLessons()->whereKey($orderable->id)->exists()
            : $this->student->enrollingCourses()->whereKey($orderable->id)->exists();

        if ($enrolled) {
            return failResponse('you are already enrolled in this resource');
        }

        $data = [
            'name' => $this->student->name,
            'email' => $this->student->email,
            'phone' => $this->student->phone,
            'orderable_id' => $orderable->id,
            'orderable_type' => $validated['orderable_type'],
            'amount' => $price,
            'student_id' => $this->student->id,
        ];

        try {
            $paymob = new PaymobService();
            $paymentData = $paymob->generatePaymentData($data);

            $orderable->orders()->create([
                'student_id' => $this->student->id,
                'amount' => $price,
                'paymob_order_id' => $paymentData['orderId'],
                'status' => PaymentStatusEnums::PENDING,
            ]);

            $paymentResource = $paymob->payWithPaymob(
                $paymentData['paymentToken'],
                $validated['wallet_number']
            );
        } catch (\Throwable $exception) {
            report($exception);
            return failResponse('Unable to initialize payment. Please try again.');
        }

        return successResponse('please check your wallet', [
            'redirect_url' => $paymentResource['redirect_url'] ?? null,
        ]);
    }

    public function callbackPayment(Request $request)
    {
        $hmac = (string) $request->input('hmac');
        if ($hmac === '') {
            return failResponse('invalid request');
        }

        try {
            $paymob = new PaymobService();
            if (!$paymob->verifyHmac($request->all(), $hmac)) {
                return failResponse('invalid payment signature');
            }
        } catch (\Throwable $exception) {
            report($exception);
            return failResponse('payment verification failed');
        }

        $transactionId = (int) $request->input('id');
        $paymobOrderId = (int) $request->input('order');
        if ($transactionId <= 0 || $paymobOrderId <= 0) {
            return failResponse('invalid request');
        }

        $order = $this->student->orders()
            ->where('paymob_order_id', $paymobOrderId)
            ->first();

        if (!$order) {
            return failResponse('not found order');
        }

        if ($order->status === PaymentStatusEnums::SUCCESS) {
            return successResponse('payment already processed');
        }

        if (!$request->boolean('success')) {
            $order->update([
                'transaction_id' => $transactionId,
                'status' => PaymentStatusEnums::FAILED,
            ]);

            return failResponse('payment failed');
        }

        if ((int) $request->input('amount_cents') !== (int) round(((float) $order->amount) * 100)) {
            return failResponse('payment amount mismatch');
        }

        DB::transaction(function () use ($order, $transactionId) {
            $freshOrder = $order->newQuery()->lockForUpdate()->findOrFail($order->id);

            if ($freshOrder->status === PaymentStatusEnums::SUCCESS) {
                return;
            }

            $orderable = $freshOrder->orderable;

            $freshOrder->update([
                'status' => PaymentStatusEnums::SUCCESS,
                'transaction_id' => $transactionId,
            ]);

            if ($orderable->getTable() === 'lessons') {
                $this->student->enrollingLessons()->syncWithoutDetaching([$orderable->id]);
            } else {
                $this->student->enrollingCourses()->syncWithoutDetaching([$orderable->id]);
            }

            $total = (float) $freshOrder->amount;
            $commissionRate = (float) config('business.commission_rate', 0.10);
            $teacherAmount = round($total * (1 - $commissionRate), 2);
            $platformAmount = round($total - $teacherAmount, 2);

            $orderable->teacher->transactions()->firstOrCreate(
                ['order_id' => $freshOrder->id],
                [
                    'total' => $total,
                    'commission' => $commissionRate,
                    'teacher_amount' => $teacherAmount,
                    'commission_amount' => $platformAmount,
                ]
            );
        });

        return successResponse('payment success and you are enrolled in this course');
    }

    public function enrollingLessons()
    {
        $enrollingLessons = $this->student->enrollingLessons()->orderByPivot('created_at', 'desc')->get();

        return successResponse(data: LessonReource::collection($enrollingLessons));
    }

    public function enrollingCourses()
    {
        $enrollingCourses = $this->student->enrollingCourses()->orderByPivot('created_at', 'desc')->get();

        return successResponse(data: CourseResource::collection($enrollingCourses));
    }

    public function enrollLesson($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);

        if (!$lesson || !is_numeric($lesson_id)) {
            return failResponse('not found lesson');
        }

        if ($this->student->enrollingLessons()->whereKey($lesson_id)->exists()) {
            return failResponse('you are already enrolled in this lesson');
        }

        if ((float) $lesson->price > 0) {
            return failResponse('this lesson is paid lesson');
        }

        $this->student->enrollingLessons()->syncWithoutDetaching([$lesson_id]);

        return successResponse('success enroll in this lesson');
    }

    public function enrollCourse($course_id)
    {
        $course = Course::find($course_id);

        if (!$course || !is_numeric($course_id)) {
            return failResponse('not found course');
        }

        if ($this->student->enrollingCourses()->whereKey($course_id)->exists()) {
            return failResponse('you are already enrolled in this course');
        }

        if ((float) $course->price > 0) {
            return failResponse('this course is paid course');
        }

        $this->student->enrollingCourses()->syncWithoutDetaching([$course->id]);

        return successResponse('success enroll in this course');
    }
}
