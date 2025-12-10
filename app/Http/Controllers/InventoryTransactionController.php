<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use App\Models\Donor;
use App\Models\InventoryTransaction;
use App\Models\Project;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryTransactions = InventoryTransaction::where('transaction_type','in')->with('donor', 'orientation')->get();
        return view('inventory_in.index', compact('inventoryTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $donors = Donor::all();
        $assistance_items = AssistanceItem::all();
        $projects = Project::all();
        return view('inventory_in.create', compact('donors', 'assistance_items', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $transaction = InventoryTransaction::create([
                'donor_id' => $request->donor_id,
                'transaction_date' => $request->transaction_date,
                'orientation' => $request->orientation,
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $row) {

                // create detail record
                TransactionItem::create([
                    'inventory_transaction_id' => $transaction->id,
                    'assistance_item_id' => $row['assistance_item_id'],
                    'quantity' => $row['quantity'],
                ]);

                // update stock
                AssistanceItem::where('id', $row['assistance_item_id'])
                    ->increment('quantity_in_stock', $row['quantity']);
            }
        });

        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryTransaction $inventoryTransaction)
    {
        return view('inventory_in.show', compact('inventoryTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryTransaction $inventoryTransaction)
    {
        return view('inventory_in.edit', compact('inventoryTransaction'));
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
