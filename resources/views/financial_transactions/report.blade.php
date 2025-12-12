@extends('dashboard.layouts.master')

@section('content')

<div class="card p-4" style="font-size: x-large;">

    <h3 class="mb-4">التقرير المالي لفترة معيّنة</h3>

    <!-- Form اختيار الفترة -->
    <form method="GET" action="{{ route('financial.report') }}">
        <div class="row mb-3">
            <div class="col">
                <label>تاريخ البداية</label>
                <input type="date" name="start_date" class="form-control" style="font-size: large;" required>
            </div>
            <div class="col">
                <label>تاريخ النهاية</label>
                <input type="date" name="end_date" class="form-control" style="font-size: large;" required>
            </div>
            <div class="col">
                <button class="btn btn-primary mt-4">تحديد</button>
            </div>
        </div>
    </form>

    @isset($transactions)

    <hr>
    <div class="row row-sm">
				<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-primary-gradient">
						<div class="pl-3 pr-3 pb-2 pt-0">
							<br>
							<div class="">
								<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">اجمالي المداخيل</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $totalIncome }}</h4>
									</div>
									<!-- <span class="float-right my-auto mr-auto">
										<i class="fas fa-arrow-circle-up text-white"></i>
										<span class="text-white op-7"> +427</span>
									</span> -->
								</div>
							</div>
						</div>
						<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-danger-gradient">
						<div class="pl-3 pr-3 pb-2 pt-0">
							<div class="">
								<br>
								<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">إجمالي النفقات</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $totalExpense }}</h4>
									</div>
									<!-- <span class="float-right my-auto mr-auto">
										<i class="fas fa-arrow-circle-down text-white"></i>
										<span class="text-white op-7"> -23.09%</span>
									</span> -->
								</div>
							</div>
						</div>
						<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-success-gradient">
						<div class="pl-3 pr-3 pb-2 pt-0">
							<div class="">
								<br>
								<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">الخزينة</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $balance }}</h4>
									</div>
									<!-- <span class="float-right my-auto mr-auto">
										<i class="fas fa-arrow-circle-up text-white"></i>
										<span class="text-white op-7"> 52.09%</span>
									</span> -->
								</div>
							</div>
						</div>
						<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-warning-gradient">
						<div class="pl-3 pr-3 pb-2 pt-0">
							<div class="">
								<br>
								<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">تحويلات المشاريع</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">َ{{ $projectTransfers }}</h4>
										
									</div>
									<!-- <span class="float-right my-auto mr-auto">
										<i class="fas fa-arrow-circle-down text-white"></i>
									</span> -->
								</div>
							</div>
						</div>
						<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
					</div>
				</div>
			</div>
            <br>

    <h4>النتائج من {{ $start }} إلى {{ $end }}</h4>

    <div class="mt-3">
        <p><strong>إجمالي المداخيل:</strong> {{ number_format($totalIncome,2) }} دج</p>
        <p><strong>إجمالي المصاريف:</strong> {{ number_format($totalExpense,2) }} دج</p>
        <p><strong>الرصيد الحالي في الخزينة:</strong> {{ number_format($balance,2) }} دج</p>
    </div>

    <h5 class="mt-4">التحويلات إلى المشاريع</h5>
    <ul>
        @foreach($projectTransfers as $projectId => $amount)
            <li>مشروع رقم {{ $projectId }} : {{ number_format($amount,2) }} دج</li>
        @endforeach
    </ul>

    <h5 class="mt-4">تفاصيل العمليات</h5>
    <table class="table table-bordered">
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
                <td>{{ $t->transaction_type == 'income' ? 'مدخول' : 'نفقة' }}</td>
                <td>{{ number_format($t->amount,2) }}</td>
                <td>{{ $t->orientation }}</td>
                <td>{{ $t->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('financial.report.print', ['start_date' => $start, 'end_date' => $end]) }}" 
       class="btn btn-success" target="_blank">طباعة التقرير</a>

    @endisset

</div>

@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('dashboard/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('dashboard/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('dashboard/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('dashboard/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('dashboard/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('dashboard/js/index.js')}}"></script>
<script src="{{URL::asset('dashboard/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection
