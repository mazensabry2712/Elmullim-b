<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\EducationLevel;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with(['subject', 'educationLevel'])
                      ->orderByDesc("created_at")
                      ->get();

        return view("panel.quizzes.index", compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        
        $educationLevels = EducationLevel::all();

        $teachers = Teacher::all();
        
        return view('panel.quizzes.create', compact('subjects', 'educationLevels',"teachers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'education_level_id' => 'required|exists:education_levels,id',
            'academic_year' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            "teacher_id"=>"required|exists:teachers,id",
            'end_time' => 'required|date_format:H:i|after:start_time',
            'time_limit' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today'
        ]);

        $data = $request->only([
            'title',
            'subject_id',
            'education_level_id',
            'academic_year',
            'start_time',
            "teacher_id",
            'end_time',
            'time_limit',
            'date'
        ]);

        Quiz::create($data);

        return redirect()->route('quizzes.index')
                       ->with('success', 'Quiz created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $subjects = Subject::all();
        
        $educationLevels = EducationLevel::all();
        
        $teachers = Teacher::all();

        return view('panel.quizzes.edit', compact('quiz', 'subjects', 'educationLevels',"teachers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'education_level_id' => 'required|exists:education_levels,id',
            'academic_year' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'time_limit' => 'required|integer|min:1',
            "teacher_id"=>"required|exists:teachers,id",
            'date' => 'required|date'
        ]);

        $data = $request->only([
            'title',
            'subject_id',
            'education_level_id',
            'academic_year',
            'start_time',
            "teacher_id",
            'end_time',
            'time_limit',
            'date'
        ]);

        $quiz->update($data);

        return redirect()->route('quizzes.index')
                       ->with('success', 'Quiz updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')
                       ->with('success', 'Quiz deleted successfully!');
    }
}
