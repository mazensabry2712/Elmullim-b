<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\MainController;
use App\Http\Controllers\Panel\QuizController;
use App\Http\Controllers\Panel\OrderController;
use App\Http\Controllers\Panel\UsersController;
use App\Http\Controllers\Panel\FamilyController;
use App\Http\Controllers\Panel\PayoutController;
use App\Http\Controllers\Panel\ContentController;
use App\Http\Controllers\Panel\CoursesController;
use App\Http\Controllers\Panel\LectureController;
use App\Http\Controllers\Panel\LessonsController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\QuestionController;
use App\Http\Controllers\Panel\StudentsController;
use App\Http\Controllers\Panel\SubjectsController;
use App\Http\Controllers\Panel\TeachersController;
use App\Http\Controllers\Panel\CountriesController;
use App\Http\Controllers\Panel\SubCategoryController;
use App\Http\Controllers\Panel\TransactionController;
use App\Http\Controllers\Panel\EducationLevelController;
use App\Http\Controllers\Panel\QuestionOptionController;
use App\Http\Controllers\Panel\EducationSystemController;
use App\Http\Controllers\Panel\CouponController;


Route::group(["prefix" => "admin-panel"], function () {

    require_once __DIR__ . '/auth.php';

    Route::group(["middleware" => "auth"], function () {

        Route::get("/", [MainController::class, "index"])->name("panel.index");
        Route::resource("/countries", CountriesController::class);
        Route::resource("/educationsystem", EducationSystemController::class);
        Route::resource("/educationlevel", EducationLevelController::class);
        Route::resource("/subjects", SubjectsController::class);

        Route::resource("/teachers", TeachersController::class);
        Route::resource("/users", UsersController::class);
        Route::resource("/families", FamilyController::class);
        Route::resource("/students", StudentsController::class);

        Route::resource("/courses", CoursesController::class);
        Route::resource("/lecture", LectureController::class);
        Route::resource("/lessons", LessonsController::class);
        Route::resource("/quizzes", QuizController::class);
        Route::resource("/questions", QuestionController::class);
        Route::resource("/question-options", QuestionOptionController::class);
        Route::resource("/categories", CategoryController::class);
        Route::resource("/sub-categories", SubCategoryController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('payouts', PayoutController::class);
        Route::patch('payouts/{payout}/status', [PayoutController::class, 'updateStatus'])
            ->name('payouts.updateStatus');
        Route::resource('contents', ContentController::class);
        Route::get('/contents/chapters/{subject}', [ContentController::class, 'getChapters']);
        Route::resource('transactions', TransactionController::class);

        // coupons
        Route::resource('coupons', CouponController::class);

    });
});
