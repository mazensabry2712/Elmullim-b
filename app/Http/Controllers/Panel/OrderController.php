<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all orders from the database
        $orders = \App\Models\Order::with('student')->get();

        // Return the view with the orders data
        return view('panel.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all students for the dropdown
        $students = \App\Models\Student::all();
        return view('panel.orders.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the order
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'paymob_order_id' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,completed,failed,cancelled',
        ]);

        $order = \App\Models\Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the order with student relationship
        $order = \App\Models\Order::with('student')->findOrFail($id);

        return view('panel.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the order by ID
        $order = \App\Models\Order::findOrFail($id);

        // Fetch all students for the dropdown
        $students = \App\Models\Student::all();

        return view('panel.orders.edit', compact('order', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate and update the order
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'paymob_order_id' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,completed,failed,cancelled',
        ]);

        $order = \App\Models\Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the order by ID and delete it
        $order = \App\Models\Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed,cancelled',
        ]);

        $order = \App\Models\Order::findOrFail($id);
        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Get orders by status
     */
    public function getByStatus(string $status)
    {
        $orders = \App\Models\Order::with('student')
            ->where('status', $status)
            ->get();

        return view('panel.orders.index', compact('orders'));
    }
}
