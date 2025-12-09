<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use App\Models\Beneficiary;
use App\Models\InventoryTransaction;
use App\Models\Project;
use Illuminate\Http\Request;

class InventoryOutController extends Controller
{
    public function index()
    {
        $inventory_outs = InventoryTransaction::where('transaction_type', 'out')->with( 'orientation')->get();
        return view('inventory_out.index', compact('inventory_outs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = AssistanceItem::all();
        $projects = Project::all();
        $families = Beneficiary::all();
        return view('inventory_out.create', compact('items', 'projects', 'families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
