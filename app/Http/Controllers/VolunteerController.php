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

    
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'membership_id' => 'required|string|unique:volunteers,membership_id',
            'gender' => 'required|in:male,female',
            'email' => 'nullable|email|max:255',
            'phone_1' => 'nullable|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'subscriptions' => 'nullable|numeric',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:50',
            'joining_date' => 'nullable|date',
            'skills' => 'nullable|string|max:255',
            'study_level' => 'nullable|in:primary,intermediate,secondary,high_school,bachelor,master,phd,other',
            'grade' => 'nullable|in:founder,active,honorary',
            'section' => 'nullable|in:planning,entry,executive,finance,management,resources,relations,media,social',
            'notes' => 'nullable|string',
        ]);

        Volunteer::create($request->all());

        return redirect()->route('volunteers.create')->with('success', 'تم تسجيل المتطوع بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Volunteer $volunteer)
    {
        $volunteerData = [
            'الاسم الكامل' => $volunteer->full_name,
            'رقم العضوية' => $volunteer->membership_id,
            'الجنس' => $volunteer->gender,
            'البريد الالكتروني' => $volunteer->email,
            'الهاتف 1' => $volunteer->phone_1,
            'الهاتف 2' => $volunteer->phone_2,
            'العنوان' => $volunteer->address,
            'الاشتراكات' => $volunteer->subscriptions,
            'تاريخ الميلاد' => $volunteer->date_of_birth,
            'الرقم الوطني' => $volunteer->national_id,
            'تاريخ الانضمام' => $volunteer->joining_date,
            'المستوى الدواسي' => $volunteer->study_level,
            'الصنف' => $volunteer->grade,
            'القسم' => $volunteer->section,
            'المهارات' => $volunteer->skills,
            'ملاحضات' => $volunteer->notes,

        ];
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
            'subscriptions' => 'nullable|numeric',
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

    public function statistics()
    {
        return view('volunteers.statistics');
    }
}
