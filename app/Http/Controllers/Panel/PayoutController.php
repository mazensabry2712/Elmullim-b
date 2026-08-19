<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;
use App\Models\Teacher;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payouts = Payout::with('teacher')->get();
        return view('panel.payouts.index', compact('payouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('panel.payouts.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,canceled',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        Payout::create($validated);

        return redirect()->route('payouts.index')->with('success', 'Payout created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payout = Payout::with('teacher')->findOrFail($id);
        return view('panel.payouts.show', compact('payout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payout = Payout::findOrFail($id);
        $teachers = Teacher::all();
        return view('panel.payouts.edit', compact('payout', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,canceled',
            'transaction_id' => 'nullable|string|max:255',
        ]);

        $payout = Payout::findOrFail($id);
        $payout->update($validated);

        return redirect()->route('payouts.index')->with('success', 'Payout updated successfully.');
    }


    public function updateStatus(Request $request, $id)
{
    $payout = Payout::findOrFail($id);
    $payout->update(['status' => $request->status]);
    return redirect()->route('payouts.index')->with('success', 'Payout status updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payout = Payout::findOrFail($id);
        $payout->delete();

        return redirect()->route('payouts.index')->with('success', 'Payout deleted successfully.');
    }
}
