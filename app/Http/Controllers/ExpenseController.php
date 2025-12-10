<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\FinancialTransaction;
use App\Models\Project;
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
        $projects = Project::all();
        $beneficiaries = Beneficiary::all();
        return view('expenses.create', compact('projects', 'beneficiaries'));
    }

    public function store(Request $request)
{
    $request->validate([
        'out_orientation' => 'required|string',
        'transaction_date' => 'required|date',
        'amount' => 'required|numeric',
        'project_id' => 'required_if:out_orientation,project|nullable|exists:projects,id',
        'beneficiary_id' => 'required_if:out_orientation,sponsored_family|nullable|exists:beneficiaries,id',
        'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'notes' => 'nullable|string|max:1000',
    ]);

    $data = [
        'out_orientation' => $request->out_orientation,
        'transaction_type' => 'expense',
        'transaction_date' => $request->transaction_date,
        'amount' => $request->amount,
        'notes' => $request->notes,
    ];

    // Attach project_id or beneficiary_id depending on the orientation
    if ($request->out_orientation === 'project') {
        $data['project_id'] = $request->project_id;
    } elseif ($request->out_orientation === 'sponsored_family') {
        $data['beneficiary_id'] = $request->beneficiary_id;
    }

    // Handle file upload if exists
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('attachments'), $filename);
        $data['attachment'] = $filename;
    }

    FinancialTransaction::create($data);

    return redirect()->route('expenses.index')->with('success', 'تم حفظ البيانات بنجاح');
}

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
