<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\BeneficiaryCategory;
use App\Models\Device;
use App\Models\District;
use App\Models\Loan;
use App\Models\Municipality;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $devices = Device::all();
        $beneficiaries = Beneficiary::all();
        $categories = BeneficiaryCategory::all();
        $municipalities = Municipality::all();
        $districts = District::all();

        return view('loans.create', compact(
            'devices',
            'beneficiaries',
            'categories',
            'municipalities',
            'districts'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
            'loan_date' => 'required|date',
        ]);

        // If new beneficiary
        if ($request->new_beneficiary == 1) {

            $beneficiary = Beneficiary::create([
                'beneficiary_category_id' => $request->beneficiary_category_id,
                'full_name' => $request->full_name,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'phone_1' => $request->phone_1,
                'social_status' => $request->social_status,
                'gender' => $request->gender,
                'municipality_id' => $request->municipality_id,
                'district_id' => $request->district_id,
                'barcode' => uniqid(),
                'nbr_in_family' => 1,
                'national_id' => uniqid(),
            ]);

            $beneficiary_id = $beneficiary->id;
        }

        // If existing
        else {
            $beneficiary_id = $request->beneficiary_id;
        }

        Loan::create([
            'device_id' => $request->device_id,
            'beneficiary_id' => $beneficiary_id,
            'new_beneficiary' => $request->new_beneficiary ? true : false,
            'loan_date' => $request->loan_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('loans.index')->with('success', 'تم تسجيل الإعارة بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);

        $devices = Device::all();
        $beneficiaries = Beneficiary::all();
        $categories = BeneficiaryCategory::all();
        $municipalities = Municipality::all();
        $districts = District::all();

        return view('loans.edit', compact(
            'loan',
            'devices',
            'beneficiaries',
            'categories',
            'municipalities',
            'districts'
        ));
    }


    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'device_id' => 'required',
            'loan_date' => 'required|date',
        ]);

        // If type = new beneficiary
        if ($request->beneficiary_type == 'new') {

            // If the loan already had a new beneficiary → update him
            if ($loan->new_beneficiary) {

                $beneficiary = Beneficiary::find($loan->beneficiary_id);

                $beneficiary->update([
                    'beneficiary_category_id' => $request->beneficiary_category_id,
                    'full_name' => $request->full_name,
                    'date_of_birth' => $request->date_of_birth,
                    'place_of_birth' => $request->place_of_birth,
                    'phone_1' => $request->phone_1,
                    'social_status' => $request->social_status,
                    'gender' => $request->gender,
                    'municipality_id' => $request->municipality_id,
                    'district_id' => $request->district_id,
                ]);
            }

            // If this loan was using an existing beneficiary → create new one
            else {
                $newBeneficiary = Beneficiary::create([
                    'beneficiary_category_id' => $request->beneficiary_category_id,
                    'full_name' => $request->full_name,
                    'date_of_birth' => $request->date_of_birth,
                    'place_of_birth' => $request->place_of_birth,
                    'phone_1' => $request->phone_1,
                    'social_status' => $request->social_status,
                    'gender' => $request->gender,
                    'municipality_id' => $request->municipality_id,
                    'district_id' => $request->district_id,
                    'barcode' => uniqid(),
                    'nbr_in_family' => 1,
                    'national_id' => uniqid(),
                ]);

                $loan->beneficiary_id = $newBeneficiary->id;
                $loan->new_beneficiary = true;
            }
        }

        // If type = existing beneficiary
        else {
            $loan->beneficiary_id = $request->beneficiary_id;
            $loan->new_beneficiary = false;
        }

        // Update loan
        $loan->update([
            'device_id' => $request->device_id,
            'loan_date' => $request->loan_date,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('loans.index')->with('success', 'تم تعديل الإعارة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
