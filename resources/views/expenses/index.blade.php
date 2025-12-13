@extends('dashboard.layouts.master')

@section('title')
النفقات

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto" style="font-size: xx-large">النفـقات</h4>
		</div>
	</div>

</div>
<div class="row row-sm">
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pr-3 pb-2 pt-0">
				<br>
				<div class="">
					<h6 class="mb-3 tx-12 text-white" style="font-size: x-large"> عدد التحويلات</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\FinancialTransaction::where('transaction_type', 'expense')->count() }}</h4>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
						</span>
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
					<h6 class="mb-3 tx-12 text-white" style="font-size: x-large"> نفقات المشاريع الكلية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\FinancialTransaction::where('transaction_type', 'expense')->where('out_orientation', 'project')->sum('amount') }}</h4>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-down text-white"></i>
						</span>
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
					<h6 class="mb-3 tx-12 text-white" style="font-size: x-large"> النفقات الكلية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\FinancialTransaction::where('transaction_type', 'expense')->sum('amount') }}</h4>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-up text-white"></i>
						</span>
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
					<h6 class="mb-3 tx-12 text-white" style="font-size: x-large"> الرصيد الكلي</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">َ{{ \App\Models\FinancialTransaction::value('new_balance') }}</h4>
						</div>
						<span class="float-right my-auto mr-auto">
							<i class="fas fa-arrow-circle-down text-white"></i>
						</span>
					</div>
				</div>
			</div>
			<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
		</div>
	</div>
</div>

<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
	<!--div-->
	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<!-- Button trigger modal -->
					<a href="{{ route('expenses.create') }}" class="btn btn-primary">
						إضافة مصروف
					</a>
				</div>
			</div>
			<div>
				@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
				@endif
				@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0" style="font-size: x-large">الرقم</th>
								<th class="border-bottom-0" style="font-size: x-large">المبلغ</th>
								<th class="border-bottom-0" style="font-size: x-large">التوجيه</th>
								<th class="border-bottom-0" style="font-size: x-large">التاريخ</th>
								<th class="border-bottom-0" style="font-size: x-large">الاجراءات</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($expenses as $expense)
							<tr>
								<td>{{ $expense->id }}</td>
								<td>{{ $expense->amount }}</td>
								<td>{{ $expense->out_orientation }}</td>
								<td>{{ $expense->transaction_date }}</td>
								<td>
									<a class="modal-effect btn btn-sm btn-success" href="{{ route('expenses.show', $expense->id) }}">عرض<i class="las la-pen"></i></a>
									<a class="modal-effect btn btn-sm btn-info" href="{{ route('expenses.edit', $expense->id) }}">تعديل<i class="las la-pen"></i></a>
									<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-toggle="modal" href="#delete{{$expense->id}}">حذف<i class="las la-trash"></i></a>
								</td>
								<td></td>
							</tr>
							@include('expenses.delete')
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/js/table-data.js')}}"></script>
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