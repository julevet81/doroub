<?php

namespace App\Http\Controllers;

use App\Models\Demond;
use Illuminate\Http\Request;

class DemondController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demonds = Demond::all();
        return view('demonds.index', compact('demonds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('demonds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'demand_date' => 'required|date',
            'treated_by' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);
        Demond::create($validatedData);
        return redirect()->route('demonds.index')->with('success', 'تم إضافة الطلب بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demond $demond)
    {
        return view('demonds.show', compact('demond'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demond $demond)
    {
        return view('demonds.edit', compact('demond'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demond $demond)
    {
        $validatedData = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'demand_date' => 'required|date',
            'treated_by' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);
        $demond->update($validatedData);
        return redirect()->route('demonds.index')->with('success', 'تم تحديث الطلب بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demond $demond)
    {
        $demond->delete();
        return redirect()->route('demonds.index')->with('success', 'تم حذف الطلب بنجاح.');
    }
}
