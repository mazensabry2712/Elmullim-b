<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Subject;
use App\Models\EducationLevel;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects =Subject::orderByDesc("created_at")->get();

        return view("panel.subjects.index", compact('subjects'));
    }


public function create()
{
    $educationLevels = EducationLevel::all();
    return view('panel.subjects.create', compact('educationLevels'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:subjects,name',
        'education_level_id' => 'required|exists:education_levels,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->only(['name', 'education_level_id']);

    // Handle image upload
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('subjects', 'public');
    }

    Subject::create($data);

    return redirect()->route('subjects.index')
                   ->with('success', 'Subject created successfully!');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }




public function edit(Subject $subject)
{
    $educationLevels = EducationLevel::all();
    return view('panel.subjects.edit', compact('subject', 'educationLevels'));
}

public function update(Request $request, Subject $subject)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'education_level_id' => 'required|exists:education_levels,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'remove_image' => 'nullable|boolean'
    ]);

    $data = $request->only(['name', 'education_level_id']);

    // Handle image removal
    if ($request->has('remove_image') && $request->remove_image) {
        if ($subject->image) {
            Storage::disk('public')->delete($subject->image);
            $data['image'] = null;
        }
    }

    // Handle new image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($subject->image) {
            Storage::disk('public')->delete($subject->image);
        }

        $data['image'] = $request->file('image')->store('subjects', 'public');
    }

    $subject->update($data);

    return redirect()->route('subjects.index')
                   ->with('success', 'Subject updated successfully!');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Find the subject by ID
        $subject = Subject::findOrFail($subject->id);
        // Delete the subject
        $subject->delete();
        // Redirect back with success message
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
