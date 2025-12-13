@extends('dashboard.layouts.master')

@section('content')
<div class="container">

    <h3 class="mb-3">تعديل تقرير إتلاف الجهاز</h3>

    <form method="POST"
        action="{{ route('devices.destruction.preview', $device->id) }}"
        target="previewFrame">
        @csrf

        <label>اسم الجهاز</label>
        <input class="form-control mb-2" value="{{ $device->name }}" disabled>

        <label>رقم الجرد</label>
        <input class="form-control mb-2" value="{{ $device->barcode }}" disabled>

        <label>العدد</label>
        <input type="number" name="usage_count" class="form-control mb-2" required>

        <label>سبب الإتلاف</label>
        <textarea name="destruction_reason" class="form-control mb-2" required></textarea>

        <label>تاريخ الإتلاف</label>
        <input type="date" name="destruction_date"
            class="form-control mb-3" required>

        <button class="btn btn-success">معاينة قبل الطباعة</button>
    </form>
    <hr>

    <iframe name="previewFrame"
        width="100%"
        height="800"
        style="border:1px solid #ccc;">
    </iframe>
    <br>
    <button onclick="document.querySelector('iframe').contentWindow.print()"
        class="btn btn-danger mt-2">
        طباعة
    </button>

</div>
@endsection