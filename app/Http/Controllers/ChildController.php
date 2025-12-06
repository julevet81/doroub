<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $children = Child::all();
        return view('children.index', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('children.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'gender' => 'nullable|string|max:50',
            'study_level' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:255',
            'health_status' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        Child::create($validatedData);
        return redirect()->route('children.index')->with('success', 'تم إضافة الطفل بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Child $child)
    {
        return view('children.show', compact('child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child $child)
    {
        return view('children.edit', compact('child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Child $child)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'gender' => 'nullable|string|max:50',
            'study_level' => 'nullable|string|max:255',
            'school' => 'nullable|string|max:255',
            'health_status' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        $child->update($validatedData);
        return redirect()->route('children.index')->with('success', 'تم تحديث بيانات الطفل بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route('children.index')->with('success', 'تم حذف الطفل بنجاح.');
    }
}
