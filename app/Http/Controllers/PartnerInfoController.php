<?php

namespace App\Http\Controllers;

use App\Models\PartnerInfo;
use Illuminate\Http\Request;

class PartnerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partnerInfos = PartnerInfo::all();
        return view('partner_infos.index', compact('partnerInfos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partner_infos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'study_level' => 'nullable|in:none,primary,secondary,higher',
            'health_status' => 'nullable|string|max:255',
            'insured' => 'required|boolean',
            'income_source' => 'nullable|string|max:255',
        ]);
        PartnerInfo::create($validatedData);
        return redirect()->route('partner_infos.index')->with('success', 'تم إنشاء معلومات الشريك بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PartnerInfo $partnerInfo)
    {
        return view('partner_infos.show', compact('partnerInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartnerInfo $partnerInfo)
    {
        return view('partner_infos.edit', compact('partnerInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PartnerInfo $partnerInfo)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'study_level' => 'nullable|in:none,primary,secondary,higher',
            'health_status' => 'nullable|string|max:255',
            'insured' => 'required|boolean',
            'income_source' => 'nullable|string|max:255',
        ]);
        $partnerInfo->update($validatedData);
        return redirect()->route('partner_infos.index')->with('success', 'تم تحديث معلومات الشريك بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartnerInfo $partnerInfo)
    {
        $partnerInfo->delete();
        return redirect()->route('partner_infos.index')->with('success', 'تم حذف معلومات الشريك بنجاح.');
    }
}
