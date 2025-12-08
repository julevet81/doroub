<?php

namespace App\Http\Controllers;

use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = FinancialTransaction::where('transaction_type', 'expense')->with('donor', 'out_orientation', 'amount')->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'orientation' => 'nullable|in:project,family',
            'payment_method' => 'nullable|in:cash,bank_transfer,credit_card,other',
            'invoice_id' => 'nullable|exists:invoices,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $expense = FinancialTransaction::create($request->all());
        $expense->previous_balance = FinancialTransaction::latest()->value('new_balance') ?? 0;
        $expense->new_balance = $expense->previous_balance - $expense->amount;
        $expense->save();


        return redirect()->route('expenses.index')->with('success', 'تم إنشاء المصروف بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = FinancialTransaction::findOrFail($id);
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = FinancialTransaction::findOrFail($id);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'orientation' => 'nullable|in:project,family',
            'payment_method' => 'nullable|in:cash,bank_transfer,credit_card,other',
            'invoice_id' => 'nullable|exists:invoices,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $expense = FinancialTransaction::findOrFail($id);
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'تم تحديث المصروف بنجاح.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = FinancialTransaction::findOrFail($id);
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'تم حذف المصروف بنجاح.');
    }
}
