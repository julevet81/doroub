@extends('layouts.app')

@section('content')

    <div class="container" dir="rtl">

        <h3 class="mb-4">إعداد محضر الإتلاف</h3>

        <form action="{{ route('devices.print', $device->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>اسم الجهاز</label>
                <input type="text" name="name" class="form-control" value="{{ $device->name }}">
            </div>

            <div class="mb-3">
                <label>الرقم التسلسلي</label>
                <input type="text" name="serial_number" class="form-control" value="{{ $device->serial_number }}">
            </div>

            <div class="mb-3">
                <label>الباركود</label>
                <input type="text" name="barcode" class="form-control" value="{{ $device->barcode }}">
            </div>

            <div class="mb-3">
                <label>سبب الإتلاف</label>
                <textarea name="destruction_reason" class="form-control">{{ $device->destruction_reason }}</textarea>
            </div>

            <div class="mb-3">
                <label>تاريخ الإتلاف</label>
                <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-print"></i> تأكيد و طباعة
            </button>
        </form>
    </div>

@endsection