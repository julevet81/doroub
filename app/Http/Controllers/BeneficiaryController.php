<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('beneficiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'phone_1' => 'nullable|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'social_status' => 'required|in:maried,single,divorced,widowed',
            'nbr_in_family' => 'required|integer|min:1',
            'partner_id' => 'required|exists:partners,id',
            'nbr_studing' => 'nullable|integer|min:0',
            'job' => 'nullable|string|max:255',
            'insured' => 'required|boolean',
            'study_level' => 'nullable|in:none,primary,secondary,higher',
            'health_status' => 'nullable|string|max:255',
            'income_source' => 'nullable|string|max:255',
            'barcode' => 'required|string|max:100|unique:beneficiaries,barcode',
            'district_id' => 'required|exists:districts,id',
            'city' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'house_status' => 'required|in:owned,rented,family',
            'national_id' => 'required|string|max:100|unique:beneficiaries,national_id',
            'national_id_at' => 'nullable|string|max:255',
            'national_id_from' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'beneficiary_category_id' => 'required|exists:beneficiary_categories,id',
        ]);
        Beneficiary::create($validatedData);
        return redirect()->route('beneficiaries.index')->with('success', 'تم إضافة المستفيد بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Beneficiary $beneficiary)
    {
        return view('beneficiaries.show', compact('beneficiary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beneficiary $beneficiary)
    {
        return view('beneficiaries.edit', compact('beneficiary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'phone_1' => 'nullable|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'social_status' => 'required|in:maried,single,divorced,widowed',
            'nbr_in_family' => 'required|integer|min:1',
            'partner_id' => 'required|exists:partners,id',
            'nbr_studing' => 'nullable|integer|min:0',
            'job' => 'nullable|string|max:255',
            'insured' => 'required|boolean',
            'study_level' => 'nullable|in:none,primary,secondary,higher',
            'health_status' => 'nullable|string|max:255',
            'income_source' => 'nullable|string|max:255',
            'barcode' => 'required|string|max:100|unique:beneficiaries,barcode,' . $beneficiary->id,
            'district_id' => 'required|exists:districts,id',
            'city' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'house_status' => 'required|in:owned,rented,family',
            'national_id' => 'required|string|max:100|unique:beneficiaries,national_id,' . $beneficiary->id,
            'national_id_at' => 'nullable|string|max:255',
            'national_id_from' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'beneficiary_category_id' => 'required|exists:beneficiary_categories,id',
        ]);
        $beneficiary->update($validatedData);
        return redirect()->route('beneficiaries.index')->with('success', 'تم تحديث بيانات المستفيد بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->route('beneficiaries.index')->with('success', 'تم حذف المستفيد بنجاح.');
    }
}
