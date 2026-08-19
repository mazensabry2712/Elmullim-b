<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use App\Models\EducationSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EducationLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all education levels with their related education systems
            $educationLevels = EducationLevel::with(['educationSystem.country'])
                ->orderBy('created_at',"DESC")
                ->get();

            return view('panel.education-level.index', compact('educationLevels'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading education levels: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Get all education systems with their countries for the dropdown
            $educationSystems = EducationSystem::with('country')
                ->orderBy('name')
                ->get();

            return view('panel.education-level.create', compact('educationSystems'));
        } catch (\Exception $e) {
            return redirect()->route('educationlevel.index')
                ->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'min:2',
                ],
                'education_system_id' => [
                    'required',
                    'exists:education_systems,id'
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000'
                ]
            ], [
                'name.required' => 'Education level name is required.',
                'name.min' => 'Education level name must be at least 2 characters.',
                'name.max' => 'Education level name cannot exceed 255 characters.',
                'education_system_id.required' => 'Please select an education system.',
                'education_system_id.exists' => 'Selected education system is invalid.',
                'description.max' => 'Description cannot exceed 1000 characters.'
            ]);

            // Check for duplicate name within the same education system
            $exists = EducationLevel::where('name', $validatedData['name'])
                ->where('education_system_id', $validatedData['education_system_id'])
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'An education level with this name already exists in the selected education system.');
            }

            // Use database transaction for data integrity
            DB::beginTransaction();

            // Create a new education level
            $educationLevel = EducationLevel::create([
                'name' => trim($validatedData['name']),
                'education_system_id' => $validatedData['education_system_id'],
                'description' => isset($validatedData['description']) ? trim($validatedData['description']) : null,
            ]);

            DB::commit();

            return redirect()->route('educationlevel.index')
                ->with('success', 'Education level "' . $educationLevel->name . '" created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating education level: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EducationLevel $educationlevel)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationLevel $educationlevel)
    {
        try {
            // Get all education systems with their countries for the dropdown
            $educationSystems = EducationSystem::with('country')
                ->orderBy('name')
                ->get();

            // Load the education level with its relationships
            $educationlevel->load(['educationSystem.country']);

            return view('panel.education-level.edit', [
                'educationLevel' => $educationlevel,
                'educationSystems' => $educationSystems
            ]);

        } catch (\Exception $e) {
            return redirect()->route('educationlevel.index')
                ->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationLevel $educationlevel)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'min:2',
                ],
                'education_system_id' => [
                    'required',
                    'exists:education_systems,id'
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000'
                ]
            ], [
                'name.required' => 'Education level name is required.',
                'name.min' => 'Education level name must be at least 2 characters.',
                'name.max' => 'Education level name cannot exceed 255 characters.',
                'education_system_id.required' => 'Please select an education system.',
                'education_system_id.exists' => 'Selected education system is invalid.',
                'description.max' => 'Description cannot exceed 1000 characters.'
            ]);

            // Check for duplicate name within the same education system (excluding current record)
            $exists = EducationLevel::where('name', $validatedData['name'])
                ->where('education_system_id', $validatedData['education_system_id'])
                ->where('id', '!=', $educationlevel->id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'An education level with this name already exists in the selected education system.');
            }

            // Use database transaction for data integrity
            DB::beginTransaction();

            // Update the education level
            $educationlevel->update([
                'name' => trim($validatedData['name']),
                'education_system_id' => $validatedData['education_system_id'],
                'description' => isset($validatedData['description']) ? trim($validatedData['description']) : null,
            ]);

            DB::commit();

            return redirect()->route('educationlevel.index')
                ->with('success', 'Education level "' . $educationlevel->name . '" updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating education level: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationLevel $educationlevel)
    {
        try {

            DB::beginTransaction();

            $levelName = $educationlevel->name;

            // Delete the education level
            $educationlevel->delete();

            DB::commit();

            return redirect()->route('educationlevel.index')
                ->with('success', 'Education level "' . $levelName . '" deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting education level: ' . $e->getMessage());
        }
    }

    /**
     * Get education levels by education system (AJAX endpoint)
     */
    public function getByEducationSystem(Request $request)
    {
        try {
            $educationSystemId = $request->get('education_system_id');

            if (!$educationSystemId) {
                return response()->json(['error' => 'Education system ID is required'], 400);
            }

            $educationLevels = EducationLevel::where('education_system_id', $educationSystemId)
                ->orderBy('name')
                ->get(['id', 'name']);

            return response()->json([
                'success' => true,
                'data' => $educationLevels
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading education levels: ' . $e->getMessage()
            ], 500);
        }
    }
}
