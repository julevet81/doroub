<html>
<head>
    <style>
        body { font-family: "Tahoma"; direction: rtl; text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body onload="window.print()">

<h2>التقرير المالي</h2>
<p><strong>الفترة:</strong> من {{ $start }} إلى {{ $end }}</p>

<p><strong>إجمالي المداخيل:</strong> {{ number_format($totalIncome,2) }} دج</p>
<p><strong>إجمالي المصاريف:</strong> {{ number_format($totalExpense,2) }} دج</p>
<p><strong>الرصيد الحالي:</strong> {{ number_format($balance,2) }} دج</p>

<h3>التحويلات إلى المشاريع</h3>
<ul>
    @foreach($projectTransfers as $projectId => $amount)
        <li>مشروع رقم {{ $projectId }} : {{ number_format($amount,2) }} دج</li>
    @endforeach
</ul>

<h3>تفاصيل العمليات</h3>
<table>
    <thead>
    <tr>
        <th>التاريخ</th>
        <th>النوع</th>
        <th>القيمة</th>
        <th>التوجيه</th>
        <th>الوصف</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $t)
        <tr>
            <td>{{ $t->transaction_date }}</td>
            <td>{{ $t->transaction_type }}</td>
            <td>{{ number_format($t->amount,2) }}</td>
            <td>{{ $t->orientation }}</td>
            <td>{{ $t->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
