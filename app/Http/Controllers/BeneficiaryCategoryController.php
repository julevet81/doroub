<?php

namespace App\Http\Controllers;

use App\Models\BeneficiaryCategory;
use Illuminate\Http\Request;

class BeneficiaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiaryCategories = BeneficiaryCategory::all();
        return view('beneficiary_categories.index', compact('beneficiaryCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('beneficiary_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:beneficiary_categories,name',
            'description' => 'nullable|string',
        ]);

        BeneficiaryCategory::create($request->all());

        return redirect()->route('beneficiary_categories.index')->with('success', 'تم إنشاء فئة المستفيدين بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BeneficiaryCategory $beneficiaryCategory)
    {
        return view('beneficiary_categories.show', compact('beneficiaryCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BeneficiaryCategory $beneficiaryCategory)
    {
        return view('beneficiary_categories.edit', compact('beneficiaryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BeneficiaryCategory $beneficiaryCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:beneficiary_categories,name,' . $beneficiaryCategory->id,
            'description' => 'nullable|string',
        ]);

        $beneficiaryCategory->update($request->all());

        return redirect()->route('beneficiary_categories.index')->with('success', 'تم تحديث فئة المستفيدين بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BeneficiaryCategory $beneficiaryCategory)
    {
        $beneficiaryCategory->delete();
        return redirect()->route('beneficiary_categories.index')->with('success', 'تم حذف فئة المستفيدين بنجاح.');
    }
}
