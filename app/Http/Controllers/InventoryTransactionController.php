<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use Illuminate\Http\Request;

class InventoryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryTransactions = InventoryTransaction::all();
        return view('inventory_transactions.index', compact('inventoryTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory_transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|string|max:50',
            'donor_id' => 'nullable|exists:donors,id',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        InventoryTransaction::create($request->all());
        return redirect()->route('inventory_transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryTransaction $inventoryTransaction)
    {
        return view('inventory_transactions.show', compact('inventoryTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryTransaction $inventoryTransaction)
    {
        return view('inventory_transactions.edit', compact('inventoryTransaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryTransaction $inventoryTransaction)
    {
        $request->validate([
            'transaction_type' => 'required|string|max:50',
            'donor_id' => 'nullable|exists:donors,id',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        $inventoryTransaction->update($request->all());
        return redirect()->route('inventory_transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryTransaction $inventoryTransaction)
    {
        $inventoryTransaction->delete();
        return redirect()->route('inventory_transactions.index');
    }
}
