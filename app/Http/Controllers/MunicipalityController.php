<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    
    public function index()
    {
        $municipalities = Municipality::all();
        return view('municipalities.index', compact('municipalities'));
    }

    public function create()
    {
        return view('municipalities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        Municipality::create($request->all());

        return redirect()->route('municipalities.index')
                         ->with('success', 'تم إضافة البلدية بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipality $municipality)
    {
        return view('municipalities.show', compact('municipality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Municipality $municipality)
    {
        return view('municipalities.edit', compact('municipality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Municipality $municipality)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        $municipality->update($request->all());

        return redirect()->route('municipalities.index')
                         ->with('success', 'تم تحديث البلدية بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();

        return redirect()->route('municipalities.index')
                         ->with('success', 'تم حذف البلدية بنجاح.');
    }
}
