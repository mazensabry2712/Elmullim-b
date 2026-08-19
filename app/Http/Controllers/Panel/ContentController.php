<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::orderBy('created_at', 'desc')->get();
        return view("panel.contents.index", compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.contents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new content
        Content::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'contentable_type' => 'App\Models\Content',
            'contentable_id' => 1,
        ]);

        // Redirect back with success message
        return redirect()->route('contents.index')->with('success', 'Content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = Content::findOrFail($id);
        return view('panel.contents.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Content::findOrFail($id);
        return view('panel.contents.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Find the content and update it
        $content = Content::findOrFail($id);
        $content->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Redirect back with success message
        return redirect()->route('contents.index')->with('success', 'Content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the content and delete it
        $content = Content::findOrFail($id);
        $content->delete();

        // Redirect back with success message
        return redirect()->route('contents.index')->with('success', 'Content deleted successfully.');
    }
}
