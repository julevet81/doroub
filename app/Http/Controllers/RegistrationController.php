<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::all();
        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'status' => 'required|in:accepted,in_study,rejected',
            'notes' => 'nullable|string',
        ]);
        Registration::create($request->all());
        return redirect()->route('registrations.index')->with('success', 'تم إنشاء التسجيل بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        return view('registrations.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        return view('registrations.edit', compact('registration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'status' => 'required|in:accepted,in_study,rejected',
            'notes' => 'nullable|string',
        ]);
        $registration->update($request->all());
        return redirect()->route('registrations.index')->with('success', 'تم تحديث التسجيل بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('registrations.index')->with('success', 'تم حذف التسجيل بنجاح.');
    }
}
