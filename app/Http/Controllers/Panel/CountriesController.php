<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        
        return view("panel.countries.index", compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code',
        ]);

        // Create a new country
        $country = new Country();
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        $country->save();

        // Redirect back with success message
        return redirect()->route('countries.index')->with('success', 'Country created successfully.');
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
        //
        //
        $country = Country::findOrFail($id);
        return view('panel.countries.edit', compact('country'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code,' . $id,
        ]);

        // Find the country and update it
        $country  = Country::findOrFail($id);
        // dd($country);
        $country->name = $request->input('name');
        $country->code = $request->input('code');
        $country->save();


        // Redirect back with success message
        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the country and delete it
        $country = Country::findOrFail($id);
        $country->delete();

        // Redirect back with success message
        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');

    }
}
