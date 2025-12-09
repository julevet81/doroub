<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
        }

        .page {
            background-image: url('{{ public_path("destruction_template.png") }}');
            background-size: 100% 100%;
            width: 100%;
            height: 1350px;
            position: relative;
        }

        .text {
            position: absolute;
            font-size: 22px;
            font-weight: bold;
            color: #000;
        }
    </style>
</head>

<body>

    <div class="page">

        {{-- التاريخ في أعلى اليمين --}}
        <div class="text" style="top: 170px; right: 260px;">
            {{ now()->format('Y-m-d') }}
        </div>

        {{-- رقم الجهاز (يمكنك تغييره لما يناسبك) --}}
        <div class="text" style="top: 170px; left: 270px;">
            {{ $device->id }}
        </div>

        {{-- التعيين (اسم الجهاز) --}}
        <div class="text" style="top: 470px; right: 190px;">
            {{ $name }}
        </div>

        {{-- رقم الجرد (رقم الباركود) --}}
        <div class="text" style="top: 470px; right: 680px;">
            {{ $serial_number }}

        </div>

        {{-- العدد --}}
        <div class="text" style="top: 470px; right: 920px;">
            1
        </div>

        {{-- سبب الإتلاف --}}
        <div class="text" style="top: 470px; left: 190px;">
            {{ $device->destruction_reason }}
        </div>

        {{-- التاريخ أسفل النموذج (اليوم) --}}
        <div class="text" style="top: 970px; right: 260px;">
            {{ now()->format('d') }}
        </div>

        {{-- الشهر --}}
        <div class="text" style="top: 970px; right: 600px;">
            {{ now()->format('F') }}
        </div>

        {{-- السنة --}}
        <div class="text" style="top: 970px; left: 260px;">
            {{ now()->format('Y') }}
        </div>

    </div>

</body>

</html>