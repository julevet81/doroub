<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class FinancialTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financialTransactions = FinancialTransaction::where('transaction_type', 'income')->with('donor', 'orientation', 'amount')->get();
        return view('financial_transactions.index', compact('financialTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $donors = Donor::all();
        return view('financial_transactions.create', compact('donors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string|max:255',
            'donor_id' => 'nullable|exists:donors,id',
            'orientation' => 'nullable|in:project,family',
            'payment_method' => 'nullable|in:cash,bank_transfer,credit_card,other',
            'invoice_id' => 'nullable|exists:invoices,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);
        $expense = FinancialTransaction::create($request->all());
        $expense->previous_balance = FinancialTransaction::latest()->value('new_balance') ?? 0;
        $expense->new_balance = $expense->previous_balance + $expense->amount;
        $expense->save();
        return redirect()->route('financial_transactions.index')->with('success', 'تم إنشاء المعاملة المالية بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialTransaction $financialTransaction)
    {
        return view('financial_transactions.show', compact('financialTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialTransaction $financialTransaction)
    {
        return view('financial_transactions.edit', compact('financialTransaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialTransaction $financialTransaction)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string|max:255',
            'donor_id' => 'nullable|exists:donors,id',
            'orientation' => 'nullable|in:project,family',
            'payment_method' => 'nullable|in:cash,bank_transfer,credit_card,other',
            'invoice_id' => 'nullable|exists:invoices,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);
        $financialTransaction->new_balance = $financialTransaction->previous_balance + $request->amount;
        $financialTransaction->update($request->all());
        return redirect()->route('financial_transactions.index')->with('success', 'تم تحديث المعاملة المالية بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->delete();
        return redirect()->route('financial_transactions.index')->with('success', 'تم حذف المعاملة المالية بنجاح.');
    }
}
