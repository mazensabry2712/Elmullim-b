<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return view("panel.sub-category.index", compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('panel.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new subcategory
        $subcategory = new SubCategory();
        $subcategory->name = $request->input('name');
        $subcategory->description = $request->input('description');
        $subcategory->category_id = $request->input('category_id');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('subcategories', 'public');
            $subcategory->image = $imagePath;
        }

        $subcategory->save();

        // Redirect back with success message
        return redirect()->route('sub-categories.index')->with('success', 'SubCategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $subcategory = SubCategory::with('category')->findOrFail($id);
        // return view('panel.sub-category.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('panel.sub-category.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the subcategory and update it
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->name = $request->input('name');
        $subcategory->description = $request->input('description');
        $subcategory->category_id = $request->input('category_id');

        // Handle image removal if requested
        if ($request->has('remove_image')) {
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image);
                $subcategory->image = null;
            }
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('subcategories', 'public');
            $subcategory->image = $imagePath;
        }

        $subcategory->save();

        // Redirect back with success message
        return redirect()->route('sub-categories.index')->with('success', 'SubCategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the subcategory and delete it
        $subcategory = SubCategory::findOrFail($id);

        // Delete associated image if exists
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }

        $subcategory->delete();

        // Redirect back with success message
        return redirect()->route('sub-categories.index')->with('success', 'SubCategory deleted successfully.');
    }
}
