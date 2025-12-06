<?php

namespace App\Http\Controllers;

use App\Models\AssistanceCategory;
use Illuminate\Http\Request;

class AssistanceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = AssistanceCategory::all();
        return view('assistance_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assistance_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AssistanceCategory::create($request->all());

        return redirect()->route('assistance_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssistanceCategory $assistanceCategory)
    {
        return view('assistance_categories.show', compact('assistanceCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssistanceCategory $assistanceCategory)
    {
        return view('assistance_categories.edit', compact('assistanceCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssistanceCategory $assistanceCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $assistanceCategory->update($request->all());

        return redirect()->route('assistance_categories.index');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssistanceCategory $assistanceCategory)
    {
        $assistanceCategory->delete();
        return redirect()->route('assistance_categories.index');
    }
}
