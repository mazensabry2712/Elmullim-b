<?php

namespace App\Http\Controllers\Panel;

use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = \App\Models\Lesson::with('teacher')->get();

        return view('panel.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = \App\Models\Teacher::all();
        
        return view('panel.lessons.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the lesson
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('lessons/logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $lesson = \App\Models\Lesson::create($validated);

        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the lesson with teacher relationship
        $lesson = \App\Models\Lesson::with('teacher')->findOrFail($id);

        return view('panel.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the lesson by ID
        $lesson = \App\Models\Lesson::findOrFail($id);

        // Fetch all teachers for the dropdown
        $teachers = \App\Models\Teacher::all();

        return view('panel.lessons.edit', compact('lesson', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and update the lesson
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lesson = \App\Models\Lesson::findOrFail($id);

        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($lesson->logo) {
                \Storage::disk('public')->delete($lesson->logo);
            }

            $logoPath = $request->file('logo')->store('lessons/logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $lesson->update($validated);

        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the lesson by ID and delete it
        $lesson = \App\Models\Lesson::findOrFail($id);

        // Delete logo file if exists
        if ($lesson->logo) {
            Storage::disk('public')->delete($lesson->logo);
        }

        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
