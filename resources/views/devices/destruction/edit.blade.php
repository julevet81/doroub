@extends('dashboard.layouts.master')

@section('content')
    <div class="container">

        <h3 class="mb-3">تعديل تقرير إتلاف الجهاز</h3>

        <form action="{{ route('devices.destruction.update', $device->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>اسم الجهاز</label>
                <input type="text" class="form-control" value="{{ $device->name }}" disabled>
            </div>

            <div class="mb-3">
                <label>رقم الجرد</label>
                <input type="text" class="form-control" value="{{ $device->serial_number }}" disabled>
            </div>

            <div class="mb-3">
                <label>العدد</label>
                <input type="number" name="usage_count" value="{{ $device->barcode }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>تاريخ الإتلاف</label>
                <input type="date" name="destruction_date" value="{{ now()->toDateString() }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>سبب الإتلاف</label>
                <textarea name="destruction_reason" class="form-control"
                    rows="3">{{ $device->destruction_reason }}</textarea>
            </div>

            <div class="mb-3">
                <label>تقرير الإتلاف (اختياري)</label>
                <textarea name="destruction_report" class="form-control"
                    rows="3">{{ $device->destruction_report }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">معاينة قبل الطباعة</button>

        </form>

    </div>
@endsection