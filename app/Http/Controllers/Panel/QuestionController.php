<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

 public function index()
{
    $questions = Question::with(['quiz.subject', 'quiz.educationLevel'])
                       ->orderByDesc("created_at")
                       ->get();

    return view("panel.questions.index", compact('questions'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $quizzes = Quiz::with(['subject', 'educationLevel'])->get();
    return view('panel.questions.create', compact('quizzes'));
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer|min:1'
        ]);

        $data = $request->only([
            'title',
            'quiz_id',
            'score'
        ]);

        Question::create($data);

        return redirect()->route('questions.index')
                       ->with('success', 'Question created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $question->load(['quiz']);
        return view('panel.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Question $question)
{
    $quizzes = Quiz::with(['subject', 'educationLevel'])->get();
    return view('panel.questions.edit', compact('question', 'quizzes'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer|min:1'
        ]);

        $data = $request->only([
            'title',
            'quiz_id',
            'score'
        ]);

        $question->update($data);

        return redirect()->route('questions.index')
                       ->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('questions.index')
                       ->with('success', 'Question deleted successfully!');
    }
}
