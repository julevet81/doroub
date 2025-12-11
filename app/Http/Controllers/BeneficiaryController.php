<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\District;
use App\Models\Municipality;
use App\Models\PartnerInfo;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Beneficiary::query();

        // filter by district
        if ($request->district_id) {
            $query->whereHas('beneficiary', function ($q) use ($request) {
                $q->where('district_id', $request->district_id);
            });
        }

        // filter by municipality
        if ($request->municipality_id) {
            $query->whereHas('beneficiary', function ($q) use ($request) {
                $q->where('municipality_id', $request->municipality_id);
            });
        }

        // filter by city
        if ($request->city) {
            $query->whereHas('beneficiary', function ($q) use ($request) {
                $q->where('city', 'LIKE', "%{$request->city}%");
            });
        }

        // filter by number in family
        if ($request->nbr_in_family) {
            $query->whereHas('beneficiary', function ($q) use ($request) {
                $q->where('nbr_in_family', $request->nbr_in_family);
            });
        }

        // filter by social status
        if ($request->social_status) {
            $query->whereHas('beneficiary', function ($q) use ($request) {
                $q->where('social_status', $request->social_status);
            });
        }

        $beneficiaries = $query->latest()->paginate(20);

        // for select options
        $districts = District::all();
        $municipalities = Municipality::all();

        return view('beneficiaries.index', compact(
            'beneficiaries',
            'districts',
            'municipalities',
            'request'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::all();
        
        return view('beneficiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'children.*.full_name' => 'nullable|string|max:255',
        ]);

        // Save partner if exists
        $partner = PartnerInfo::create($request->partner);

        // Handle file upload
        $nationalIdPath = null;
        if ($request->hasFile('national_id_file')) {
            $nationalIdPath = $request->file('national_id_file')->store('national_ids', 'public');
        }

        // Create beneficiary
        $beneficiary = Beneficiary::create(array_merge(
            $request->except(['partner', 'children', 'national_id_file']),
            [
                'partner_id' => $partner->id,
                'national_id' => $request->national_id,
                'barcode' => uniqid(),
                'national_id_file' => $nationalIdPath,
            ]
        ));

        // Create children
        // أطفال غير بالغين
        if ($request->children['kids']) {
            foreach ($request->children['kids'] as $child) {
                $beneficiary->children()->create($child);
            }
        }

        // أطفال بالغين
        if ($request->children['adults']) {
            foreach ($request->children['adults'] as $child) {
                $beneficiary->children()->create($child);
            }
        }


        return redirect()->route('beneficiaries.create')->with('success', 'Beneficiary created successfully');
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

    public function getMunicipalities($district_id)
    {
        return Municipality::where('district_id', $district_id)->get();
    }

    public function statistics()
    {
        return view('beneficiaries.statistics');
    }
}
