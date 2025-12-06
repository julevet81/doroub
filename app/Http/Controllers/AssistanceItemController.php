<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use Illuminate\Http\Request;

class AssistanceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assistanceItems = AssistanceItem::all();
        return view('assistance_items.index', compact('assistanceItems'));
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
            'assistance_category_id' => 'required|exists:assistance_categories,id',
            'code' => 'required|string|max:255|unique:assistance_items,code',
        ]);

        AssistanceItem::create($request->all());

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
            'assistance_category_id' => 'required|exists:assistance_categories,id',
            'code' => 'required|string|max:255|unique:assistance_items,code,' . $assistanceItem->id,
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
