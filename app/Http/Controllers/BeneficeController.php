<?php

namespace App\Http\Controllers;

use App\Models\Benefice;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benefices = Benefice::all();
        $beneficiaries = Beneficiary::all();
        return view('benefices.index', compact('benefices', 'beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $beneficiaries = Beneficiary::all();
        return view('benefices.create', compact('beneficiaries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'type' => 'required|in:financial,material,service',
        ]);
        Benefice::create($validatedData);
        return redirect()->route('benefices.index')->with('success', 'تم إنشاء الإستفادة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Benefice $benefice)
    {
        return view('benefices.show', compact('benefice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Benefice $benefice)
    {
        return view('benefices.edit', compact('benefice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Benefice $benefice)
    {
        $validatedData = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'type' => 'required|in:financial,material,service',
        ]);
        $benefice->update($validatedData);
        return redirect()->route('benefices.index')->with('success', 'تم تحديث الإستفادة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benefice $benefice)
    {
        $benefice->delete();
        return redirect()->route('benefices.index')->with('success', 'تم حذف الإستفادة بنجاح.');
    }
}
