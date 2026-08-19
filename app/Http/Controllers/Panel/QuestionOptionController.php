<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all question options from the database
        $questionOptions = \App\Models\QuestionOption::with('question')->get();

        // Return the view with the question options data
        return view('panel.question-options.index', compact('questionOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all questions for the dropdown
        $questions = \App\Models\Question::all();
        return view('panel.question-options.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the question option
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'question_id' => 'required|exists:questions,id',
            'is_correct' => 'required|boolean',
        ]);

        $questionOption = \App\Models\QuestionOption::create($validated);

        return redirect()->route('question-options.index')->with('success', 'Question option created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the question option with question relationship
        $questionOption = \App\Models\QuestionOption::with('question')->findOrFail($id);

        return view('panel.question-options.show', compact('questionOption'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the question option by ID
        $questionOption = \App\Models\QuestionOption::findOrFail($id);

        // Fetch all questions for the dropdown
        $questions = \App\Models\Question::all();

        return view('panel.question-options.edit', compact('questionOption', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and update the question option
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'question_id' => 'required|exists:questions,id',
            'is_correct' => 'required|boolean',
        ]);

        $questionOption = \App\Models\QuestionOption::findOrFail($id);
        $questionOption->update($validated);

        return redirect()->route('question-options.index')->with('success', 'Question option updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the question option by ID and delete it
        $questionOption = \App\Models\QuestionOption::findOrFail($id);
        $questionOption->delete();

        return redirect()->route('question-options.index')->with('success', 'Question option deleted successfully.');
    }
}
