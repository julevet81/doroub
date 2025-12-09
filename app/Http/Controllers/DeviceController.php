<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:devices',
            'is_new' => 'required|boolean',
        ]);

        $barcode = mt_rand(100000000000, 999999999999);


        Device::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'barcode' => $barcode,
            'is_new' => $request->is_new,
        ]);

        return redirect()->route('devices.index')->with('success', 'تم إضافة الجهاز بنجاح');
    }


    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        $deviceData = [
            'الاسم' => $device->name,
            'رقم الجرد' => $device->serial_number,
            'عدد الاستعمالات' => $device->usage_count,
            'حالة الاعارة' => $device->status,
            'تقرير الاتلاف' => $device->destruction_report,
            'سبب الاتلاف' => $device->destruction_reason,
            'الباركود' => $device->barcode,
            'تاريخ الإنشاء' => $device->created_at,
            'تاريخ التحديث' => $device->updated_at,
        ];
        return view('devices.show', compact('deviceData'));
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
            'status' => 'required|boolean',
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

    public function loaned()
    {
        $devices = Device::where('status', 1)->get();

        return view('devices.loaned', compact('devices'));
    }

    public function returned()
    {
        $devices = Device::where('status', 0)->where('is_destructed', 0)->get();

        return view('devices.returned', compact('devices'));
    }

    public function destructed()
    {
        $devices = Device::where('is_destructed', true)->get();

        return view('devices.destructed', compact('devices'));
    }

    public function destruct(Request $request, Device $device)
    {
        $request->validate([
            'destruction_reason' => 'required|string|max:1000',
        ]);

        $device->update([
            'destruction_reason' => $request->destruction_reason, 
            'is_destructed' => true, 
        ]);

        return redirect()->back()->with('success', 'تم تسجيل التدمير بنجاح');
    }

    public function printForm(Device $device)
    {
        return view('devices.print_form', compact('device'));
    }


    public function print(Request $request, Device $device)
    {
        $data = [
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'barcode' => $request->barcode,
            'destruction_reason' => $request->destruction_reason,
            'date' => $request->date,
        ];

        $pdf = PDF::loadView('devices.print_destruction', $data)
            ->setPaper('A4', 'portrait');

        return $pdf->stream('محضر-الإتلاف.pdf');
    }
}