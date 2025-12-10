<?php

namespace App\Http\Controllers;

use App\Models\AssistanceCategory;
use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    
    public function index()
    {
        $donors = Donor::all();
        return view('donors.index', compact('donors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assistanceCategories = AssistanceCategory::all();
        return view('donors.create', compact('assistanceCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'activity' => 'required|string|unique:donors,activity',
            'phone' => 'nullable|string|max:20',
            'assistance_category_id' => 'required|exists:assistance_categories,id',
            'description' => 'nullable|string',
        ]);

        Donor::create($request->all());

        return redirect()->route('donors.index')->with('success', 'تم إضافة المتبرع بنجاح');
    }


    public function show(Donor $donor)
    {
        return view('donors.show', compact('donor'));
    }

    public function edit(Donor $donor)
    {
        $assistanceCategories = AssistanceCategory::all();
        return view('donors.edit', compact('donor', 'assistanceCategories'));
    }

    public function update(Request $request, Donor $donor)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'activity' => 'required|string|unique:donors,activity,' . $donor->id,
            'phone' => 'nullable|string|max:20',
            'assistance_category_id' => 'required|exists:assistance_categories,id',
            'description' => 'nullable|string',
        ]);

        $donor->update($request->all());

        return redirect()->route('donors.index')->with('success', 'تم تحديث بيانات المتبرع بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('donors.index');
    }
}
