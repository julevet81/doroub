<?php

namespace App\Http\Controllers;

use App\Models\DemondedItem;
use Illuminate\Http\Request;

class DemondedItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demondedItems = DemondedItem::all();
        return view('demonded_items.index', compact('demondedItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('demonded_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'demond_id' => 'required|exists:demonds,id',
            'assistance_item_id' => 'required|exists:assistance_items,id',
            'quantity' => 'required|integer|min:1',
        ]);
        DemondedItem::create($request->all());
        return redirect()->route('demonded_items.index')->with('success', 'تم إنشاء العنصر المطلوب بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DemondedItem $demondedItem)
    {
        return view('demonded_items.show', compact('demondedItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemondedItem $demondedItem)
    {
        return view('demonded_items.edit', compact('demondedItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DemondedItem $demondedItem)
    {
        $request->validate([
            'demond_id' => 'required|exists:demonds,id',
            'assistance_item_id' => 'required|exists:assistance_items,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $demondedItem->update($request->all());
        return redirect()->route('demonded_items.index')->with('success', 'تم تحديث العنصر المطلوب بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemondedItem $demondedItem)
    {
        $demondedItem->delete();
        return redirect()->route('demonded_items.index')->with('success', 'تم حذف العنصر المطلوب بنجاح.');
    }
}
