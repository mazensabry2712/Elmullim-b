<?php

namespace App\Http\Controllers\Panel;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students = Student::with('educationLevel')->get();
        return view("panel.student.index", compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationLevels = \App\Models\EducationLevel::all();
        return view("panel.student.create", compact('educationLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('students/profile_images', 'public');
        }

        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->password = bcrypt($request->input('password')); // Ensure password is hashed
        $student->phone = $request->input('phone');
        $student->address = $request->input('address');
        $student->description = $request->input('description');
        $student->profile_image = $profileImagePath;
        $student->gender = $request->input('gender');
        $student->education_level_id = $request->input('education_level_id');
        $student->email_verified_at = $request->input('email_verified_at') ? now() : null;
        $student->save();

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
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
        $student = \App\Models\Student::find($id);
        $educationLevels = \App\Models\EducationLevel::all();
        return view("panel.student.edit", compact('student', 'educationLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = \App\Models\Student::find($id);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($student->profile_image) {
                Storage::disk('public')->delete($student->profile_image);
            }
            $student->profile_image = $request->file('profile_image')->store('students/profile_images', 'public');
        }

        $student->name = $request->input('name');
        $student->phone = $request->input('phone');
        $student->address = $request->input('address');
        $student->description = $request->input('description');
        $student->email = $request->input('email');
        $student->education_level_id = $request->input('education_level_id');
        $student->gender = $request->input('gender');

        if ($request->input('email_verified_at')) {
            $student->email_verified_at = now();
        } else {
            $student->email_verified_at = null;
        }

        if ($request->input('password')) {
            $student->password = bcrypt($request->input('password')); // Ensure password is hashed
        }

        $student->save();

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = \App\Models\Student::find($id);
        if ($student) {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } else {
            return redirect()->route('students.index')->with('error', 'Student not found.');
        }
    }
}
