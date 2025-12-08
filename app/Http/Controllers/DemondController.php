<?php

namespace App\Http\Controllers;

use App\Models\AssistanceItem;
use App\Models\Demond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $beneficiaries = Demond::all();
        $assistance_items = AssistanceItem::all();
        return view('demonds.create', compact('beneficiaries', 'assistance_items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'demand_date' => 'required|date',
            'attachement' => 'nullable|file|max:2048',
            'description' => 'nullable|string'
        ]);

        $file = null;

        if ($request->hasFile('attachement')) {
            $file = $request->file('attachement')->store('demonds', 'public');
        }

        Demond::create([
            'beneficiary_id' => $request->beneficiary_id,
            'demand_date' => $request->demand_date,
            'treated_by' => Auth::user()->id, // optional
            'attachement' => $file,
            'description' => $request->description,
        ]);

        return redirect()->route('demonds.index')->with('success', 'تم إضافة الطلب بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(Demond $demond)
    {
        $assistance_items = AssistanceItem::all();
        return view('demonds.show', compact('demond', 'assistance_items'));
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
