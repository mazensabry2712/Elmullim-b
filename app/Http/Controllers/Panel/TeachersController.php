<?php

namespace App\Http\Controllers\Panel;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = \App\Models\Teacher::with('educationLevel', 'subjects')->get();
        return view("panel.teacher.index", compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationLevels = \App\Models\EducationLevel::all();
        return view("panel.teacher.create", compact('educationLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->password = bcrypt($request->input('password')); // Ensure password is hashed
        $teacher->phone = $request->input('phone');
        $teacher->address = $request->input('address');
        $teacher->description = $request->input('description');
        $teacher->profile_image = $request->input('profile_image');
        $teacher->experience = $request->input('experience');
        $teacher->cv = $request->input('cv');
        $teacher->course_type = $request->input('course_type');
        $teacher->gender = $request->input('gender');
        $teacher->qualification = $request->input('qualification');
        $teacher->education_level_id = $request->input('education_level_id');
        $teacher->save();

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = \App\Models\Teacher::find($id);
        $educationLevels = \App\Models\EducationLevel::all(); // إضافة هذا السطر
        return view("panel.teacher.edit", compact('teacher', 'educationLevels')); // تعديل هذا السطر
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = \App\Models\Teacher::find($id);
        $teacher->name = $request->input('name');
        $teacher->phone = $request->input('phone');
        $teacher->address = $request->input('address');
        $teacher->description = $request->input('description');
        $teacher->profile_image = $request->input('profile_image');
        $teacher->experience = $request->input('experience');
        $teacher->cv = $request->input('cv');
        $teacher->email = $request->input('email');
        $teacher->education_level_id = $request->input('education_level_id');
        $teacher->course_type = $request->input('course_type');
        $teacher->gender = $request->input('gender');
        $teacher->qualification = $request->input('qualification');

        if ($request->input('password')) {
            $teacher->password = bcrypt($request->input('password')); // Ensure password is hashed
        }

        $teacher->save();

        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = \App\Models\Teacher::find($id);
        if ($teacher) {
            $teacher->delete();
            return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
        } else {
            return redirect()->route('teachers.index')->with('error', 'Teacher not found.');
        }
    }
}
