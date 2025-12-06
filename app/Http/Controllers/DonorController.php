<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('donors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'activity' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'assistance_category_id' => 'required|exists:assistance_categories,id',
            'description' => 'nullable|string',
        ]);

        Donor::create($request->all());

        return redirect()->route('donors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donor $donor)
    {
        return view('donors.show', compact('donor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donor $donor)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'activity' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'assistance_category_id' => 'required|exists:assistance_categories,id',
            'description' => 'nullable|string',
        ]);

        $donor->update($request->all());

        return redirect()->route('donors.index');
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
