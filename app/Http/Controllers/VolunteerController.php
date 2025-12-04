<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::all();
        return view('volunteers.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('volunteers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'membership_id' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'email' => 'string|email|max:255|unique:volunteers',
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'study_level' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
        ]);

        Volunteer::create($validatedData);

        return redirect()->route('volunteers.index')->with('success', 'تم إنشاء المتطوع بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Volunteer $volunteer)
    {
        $volunteerData = $volunteer->toArray();
        return view('volunteers.show', compact('volunteerData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volunteer $volunteer)
    {
        return view('volunteers.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'membership_id' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'email' => 'string|email|max:255|unique:volunteers,email,'.$volunteer->id,
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'study_level' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
        ]);
        $volunteer->update($validatedData);

        return redirect()->route('volunteers.index')->with('success', 'تم تحديث المتطوع بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('volunteers.index')->with('success', 'تم حذف المتطوع بنجاح.');
    }
}
