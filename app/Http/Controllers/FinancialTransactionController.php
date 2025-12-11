<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\FinancialTransaction;
use App\Models\Project;
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
        $projects = Project::all();
        return view('financial_transactions.create', compact('donors', 'projects'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'transaction_date' => 'required|date',
            'orientation' => 'required|in:project,other',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'project_id' => 'required_if:orientation,project|exists:projects,id',
        ]);

        $transaction = new FinancialTransaction();
        $transaction->donor_id = $request->donor_id;
        $transaction->transaction_type = 'income';
        $transaction->transaction_date = $request->transaction_date;
        $transaction->orientation = $request->orientation;
        $transaction->amount = $request->amount;
        $transaction->notes = $request->notes;

        // Only set project_id if orientation is project
        if ($request->orientation === 'project') {
            $transaction->project_id = $request->project_id;
        }

        $transaction->save();

        return redirect()->route('inventory_transactions.create')
                         ->with('success', 'تم حفظ البيانات بنجاح');
    }

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

    public function statistics(){
        return view('financial_transactions.statistics');
    }
}
