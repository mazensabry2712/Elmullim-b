<?php

namespace App\Http\Controllers\Panel;

use App\Models\Family;
use App\Models\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = Family::with('educationLevel')->get();
        return view('panel.families.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationLevels = EducationLevel::all();
        return view('panel.families.create', compact('educationLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:familes,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'education_level_id' => 'nullable|exists:education_levels,id',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        $data["email_verified_at"]= $request->input('email_verified_at') ? now() : null;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        Family::create($data);

        return redirect()->route('families.index')->with('success', 'Parent created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        $parent = $family;
        $educationLevels = EducationLevel::all();
        return view('panel.families.edit', compact('parent', 'educationLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:familes,email,' . $family->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'education_level_id' => 'nullable|exists:education_levels,id',
            'description' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        $data["email_verified_at"]= $request->input('email_verified_at') ? now() : null;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($family->profile_image) {
                Storage::disk('public')->delete($family->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // Hash password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $family->update($data);

        return redirect()->route('families.index')->with('success', 'Parent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        // Delete profile image if exists
        if ($family->profile_image) {
            Storage::disk('public')->delete($family->profile_image);
        }

        $family->delete();

        return redirect()->route('families.index')->with('success', 'Parent deleted successfully.');
    }
}
