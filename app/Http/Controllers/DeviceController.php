<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:devices,serial_number',
            'status' => 'required|in:loaned,returned',
            'usage_count' => 'required|integer',
            'destruction_report' => 'nullable|string',
            'destruction_reason' => 'nullable|string',
            'barcode' => 'required|string|unique:devices,barcode',
            'is_new' => 'required|boolean',
        ]);
        Device::create($validatedData);
        return redirect()->route('devices.index')->with('success', 'تم إنشاء الجهاز بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:devices,serial_number,' . $device->id,
            'usage_count' => 'required|integer',
            'status' => 'required|in:loaned,returned',
            'destruction_report' => 'nullable|string',
            'destruction_reason' => 'nullable|string',
            'barcode' => 'required|string|unique:devices,barcode,' . $device->id,
            'is_new' => 'required|boolean',
        ]);
        $device->update($validatedData);
        return redirect()->route('devices.index')->with('success', 'تم تحديث الجهاز بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'تم حذف الجهاز بنجاح.');
    }
}
