<?php

namespace App\Http\Controllers\Panel;

use App\Models\Transaction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('teacher')->get();

        return view("panel.transaction.index", compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();

        return view("panel.transaction.create", compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaction = new Transaction();
        $transaction->total = $request->input('total');
        $transaction->teacher_id = $request->input('teacher_id');
        $transaction->commission = $request->input('commission');
        $transaction->teacher_amount = $request->input('teacher_amount');
        $transaction->commission_amount = $request->input('commission_amount');
        $transaction->save();

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('teacher')->find($id);
        return view("panel.transaction.show", compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::find($id);
        $teachers = Teacher::all();
        return view("panel.transaction.edit", compact('transaction', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::find($id);
        $transaction->total = $request->input('total');
        $transaction->teacher_id = $request->input('teacher_id');
        $transaction->commission = $request->input('commission');
        $transaction->teacher_amount = $request->input('teacher_amount');
        $transaction->commission_amount = $request->input('commission_amount');
        $transaction->save();

        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
        } else {
            return redirect()->route('transactions.index')->with('error', 'Transaction not found.');
        }
    }
}
