<h3>معاينة تقرير الإتلاف</h3>

<table border="1" width="100%" cellpadding="8">
    <tr><th>اسم الجهاز</th><td>{{ $device->name }}</td></tr>
    <tr><th>رقم الجرد</th><td>{{ $device->barcode }}</td></tr>
    <tr><th>العدد</th><td>{{ $data['usage_count'] }}</td></tr>
    <tr><th>سبب الإتلاف</th><td>{{ $data['destruction_reason'] }}</td></tr>
    <tr><th>التاريخ</th><td>{{ $data['destruction_date'] }}</td></tr>
</table>

<form method="POST"
      action="{{ route('devices.destruction.print', $device->id) }}">
    @csrf

    <input type="hidden" name="usage_count" value="{{ $data['usage_count'] }}">
    <input type="hidden" name="destruction_reason" value="{{ $data['destruction_reason'] }}">
    <input type="hidden" name="destruction_date" value="{{ $data['destruction_date'] }}">

    <button class="btn btn-danger mt-3">طباعة التقرير</button>
</form>
