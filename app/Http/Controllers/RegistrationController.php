<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Municipality;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with('beneficiary');

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

        $registrations = $query->latest()->paginate(20);

        // for select options
        $districts = District::all();
        $municipalities = Municipality::all();

        return view('registrations.index', compact(
            'registrations',
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
