<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("panel.admin.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("panel.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('users/profile_images', 'public');
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Ensure password is hashed
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->description = $request->input('description');
        $user->profile_image = $profileImagePath;
        $user->gender = $request->input('gender');
        $user->email_verified_at = $request->input('email_verified_at') ? now() : null;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $user = User::find($id);
        // return view("panel.admin.show", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view("panel.admin.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->profile_image = $request->file('profile_image')->store('users/profile_images', 'public');
        }

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->description = $request->input('description');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');

        if ($request->input('email_verified_at')) {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password')); // Ensure password is hashed
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            // Delete profile image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    }
}
