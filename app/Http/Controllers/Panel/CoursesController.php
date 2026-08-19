<?php

namespace App\Http\Controllers\Panel;

use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Course;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller

{
    public function index()
    {
        $courses = Course::with(['subCategory','teacher',"contents"])->get();
        
        return view("panel.courses.index", compact('courses'));
    }

    public function create()
    {
        $subCategories = SubCategory::all();
        
        $teachers = Teacher::all();
        
        return view('panel.courses.create', compact('subCategories', 'teachers'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'teacher_id' => 'required|exists:teachers,id',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);


        // Create a new course
        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->sub_category_id = $request->input('sub_category_id');
        $course->price = $request->input('price');
        $course->teacher_id = $request->input('teacher_id');
        $course->level = $request->input('level');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
            $course->image = $imagePath;
        }

        $course->save();

        // Redirect back with success message
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        
        $subCategories = SubCategory::all();
        
        $teachers = Teacher::all();
        
        return view('panel.courses.edit', compact('course', 'subCategories', 'teachers'));
    }
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'teacher_id' => 'required|exists:users,id',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);

        // Find the course and update it
        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->sub_category_id = $request->input('sub_category_id');
        $course->price = $request->input('price');
        $course->teacher_id = $request->input('teacher_id');
        $course->level = $request->input('level');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }

            $imagePath = $request->file('image')->store('courses', 'public');
            $course->image = $imagePath;
        }

        $course->save();

        // Redirect back with success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }


    public function destroy(string $id)
    {
        // Find the course and delete it
        $course = Course::findOrFail($id);

        // Delete associated image if exists
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        // Redirect back with success message
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

}
