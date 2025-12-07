<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssistanceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assistance_items = AssistanceItem::all();
        return view('assistance_items.index', compact('assistance_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assistance_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $barcode = Str::upper(Str::random(10));

        AssistanceItem::create([
            'name' => $request->name,
            'code' => $barcode
        ]);

        return redirect()->route('assistance_items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssistanceItem $assistanceItem)
    {
        return view('assistance_items.show', compact('assistanceItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssistanceItem $assistanceItem)
    {
        return view('assistance_items.edit', compact('assistanceItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssistanceItem $assistanceItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
        ]);

        $assistanceItem->update($request->all());

        return redirect()->route('assistance_items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssistanceItem $assistanceItem)
    {
        $assistanceItem->delete();
        return redirect()->route('assistance_items.index');
    }

    
}
