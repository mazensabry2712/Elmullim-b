<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all lectures with their related content
            $lectures = Lecture::with(['content'])
                ->orderBy('created_at', "DESC")
                ->get();

            return view('panel.Lectures.index', compact('lectures'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading lectures: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Get all content for the dropdown
            $contents = Content::orderBy('title')
                ->get();

            return view('panel.Lectures.create', compact('contents'));
        } catch (\Exception $e) {
            return redirect()->route('lecture.index')
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
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    'min:2',
                ],
                'content_id' => [
                    'required',
                    'exists:contents,id'
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000'
                ],
                'deuration' => [
                    'nullable',
                    'integer',
                    'min:1',
                    'max:999999'
                ],
                'video' => [
                    'nullable',
                    'file',
                    'mimes:mp4,avi,mov,wmv,flv,webm',
                    'max:1048576' // 1GB in KB
                ]
            ], [
                'title.required' => 'Lecture title is required.',
                'title.min' => 'Lecture title must be at least 2 characters.',
                'title.max' => 'Lecture title cannot exceed 255 characters.',
                'content_id.required' => 'Please select a content.',
                'content_id.exists' => 'Selected content is invalid.',
                'description.max' => 'Description cannot exceed 1000 characters.',
                'deuration.integer' => 'Duration must be a number.',
                'deuration.min' => 'Duration must be at least 1 minute.',
                'deuration.max' => 'Duration cannot exceed 999999 minutes.',
                'video.file' => 'Video must be a valid file.',
                'video.mimes' => 'Video must be of type: mp4, avi, mov, wmv, flv, webm.',
                'video.max' => 'Video file size cannot exceed 1GB.'
            ]);

            // Check for duplicate title within the same content
            $exists = Lecture::where('title', $validatedData['title'])
                ->where('content_id', $validatedData['content_id'])
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A lecture with this title already exists in the selected content.');
            }

            // Use database transaction for data integrity
            DB::beginTransaction();

            // Handle video upload
            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoPath = $video->store('lectures/videos', 'public');
            }

            // Create a new lecture
            $lecture = Lecture::create([
                'title' => trim($validatedData['title']),
                'content_id' => $validatedData['content_id'],
                'description' => isset($validatedData['description']) ? trim($validatedData['description']) : null,
                'deuration' => $validatedData['deuration'] ?? null,
                'video' => $videoPath,
            ]);

            DB::commit();

            return redirect()->route('lecture.index')
                ->with('success', 'Lecture "' . $lecture->title . '" created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating lecture: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecture $lecture)
    {
        // try {
        //     // Load the lecture with its relationships
        //     $lecture->load(['content']);

        //     return view('panel.lecture.show', compact('lecture'));
        // } catch (\Exception $e) {
        //     return redirect()->route('lecture.index')
        //         ->with('error', 'Error loading lecture: ' . $e->getMessage());
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecture $lecture)
    {
        try {
            // Get all content for the dropdown
            $contents = Content::orderBy('title')
                ->get();

            // Load the lecture with its relationships
            $lecture->load(['content']);

            return view('panel.Lectures.edit', [
                'lecture' => $lecture,
                'contents' => $contents
            ]);

        } catch (\Exception $e) {
            return redirect()->route('lecture.index')
                ->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecture $lecture)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    'min:2',
                ],
                'content_id' => [
                    'required',
                    'exists:contents,id'
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000'
                ],
                'deuration' => [
                    'nullable',
                    'integer',
                    'min:1',
                    'max:999999'
                ],
                'video' => [
                    'nullable',
                    'file',
                    'mimes:mp4,avi,mov,wmv,flv,webm',
                    'max:1048576' // 1GB in KB
                ]
            ], [
                'title.required' => 'Lecture title is required.',
                'title.min' => 'Lecture title must be at least 2 characters.',
                'title.max' => 'Lecture title cannot exceed 255 characters.',
                'content_id.required' => 'Please select a content.',
                'content_id.exists' => 'Selected content is invalid.',
                'description.max' => 'Description cannot exceed 1000 characters.',
                'deuration.integer' => 'Duration must be a number.',
                'deuration.min' => 'Duration must be at least 1 minute.',
                'deuration.max' => 'Duration cannot exceed 999999 minutes.',
                'video.file' => 'Video must be a valid file.',
                'video.mimes' => 'Video must be of type: mp4, avi, mov, wmv, flv, webm.',
                'video.max' => 'Video file size cannot exceed 1GB.'
            ]);

            // Check for duplicate title within the same content (excluding current record)
            $exists = Lecture::where('title', $validatedData['title'])
                ->where('content_id', $validatedData['content_id'])
                ->where('id', '!=', $lecture->id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'A lecture with this title already exists in the selected content.');
            }

            // Use database transaction for data integrity
            DB::beginTransaction();

            // Handle video upload
            $videoPath = $lecture->video; // Keep existing video if no new one uploaded
            if ($request->hasFile('video')) {
                // Delete old video if exists
                if ($lecture->video && Storage::disk('public')->exists($lecture->video)) {
                    Storage::disk('public')->delete($lecture->video);
                }

                $video = $request->file('video');
                $videoPath = $video->store('lectures/videos', 'public');
            }

            // Update the lecture
            $lecture->update([
                'title' => trim($validatedData['title']),
                'content_id' => $validatedData['content_id'],
                'description' => isset($validatedData['description']) ? trim($validatedData['description']) : null,
                'deuration' => $validatedData['deuration'] ?? null,
                'video' => $videoPath,
            ]);

            DB::commit();

            return redirect()->route('lecture.index')
                ->with('success', 'Lecture "' . $lecture->title . '" updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating lecture: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        try {
            DB::beginTransaction();

            $lectureTitle = $lecture->title;

            // Delete video file if exists
            if ($lecture->video && Storage::disk('public')->exists($lecture->video)) {
                Storage::disk('public')->delete($lecture->video);
            }

            // Delete the lecture
            $lecture->delete();

            DB::commit();

            return redirect()->route('lecture.index')
                ->with('success', 'Lecture "' . $lectureTitle . '" deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting lecture: ' . $e->getMessage());
        }
    }

    /**
     * Get lectures by content (AJAX endpoint)
     */
    public function getByContent(Request $request)
    {
        try {
            $contentId = $request->get('content_id');

            if (!$contentId) {
                return response()->json(['error' => 'Content ID is required'], 400);
            }

            $lectures = Lecture::where('content_id', $contentId)
                ->orderBy('title')
                ->get(['id', 'title', 'deuration']);

            return response()->json([
                'success' => true,
                'data' => $lectures
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading lectures: ' . $e->getMessage()
            ], 500);
        }
    }
}
