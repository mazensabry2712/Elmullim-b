<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
       $educationSystems = \App\Models\EducationSystem::all();
       return view('panel.education-system.index', compact('educationSystems'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $countries = \App\Models\Country::all();
        return view('panel.education-system.create', compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);
        // Create a new education system
        $educationSystem = new \App\Models\EducationSystem();
        $educationSystem->name = $validatedData['name'];
        $educationSystem->country_id = $validatedData['country_id'];
        $educationSystem->save();
        // Redirect back with success message
        return redirect()->route('educationsystem.index')->with('success', 'Education system created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // $educationSystem = \App\Models\EducationSystem::findOrFail($id);
        // return view('panel.education-system.show', compact('educationSystem'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $educationsystem = \App\Models\EducationSystem::findOrFail($id);
        $countries = \App\Models\Country::all();
        return view('panel.education-system.edit', compact('educationsystem', 'countries'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);
        // Find the education system by ID
        $educationSystem = \App\Models\EducationSystem::findOrFail($id);
        // Update the education system
        $educationSystem->name = $validatedData['name'];
        $educationSystem->country_id = $validatedData['country_id'];
        $educationSystem->save();
        // Redirect back with success message
        return redirect()->route('educationsystem.index')->with('success', 'Education system updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the education system by ID
        $educationSystem = \App\Models\EducationSystem::findOrFail($id);
        // Delete the education system
        $educationSystem->delete();
        // Redirect back with success message
        return redirect()->route('educationsystem.index')->with('success', 'Education system deleted successfully.');

    }
}
