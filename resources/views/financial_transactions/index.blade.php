@extends('dashboard.layouts.master')

@section('title')
	الإيرادات

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">الإيرادات</h4>
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
								<a href="{{ route('financial_transactions.create') }}" class="btn btn-primary" style="font-size: large;">
									إضافة مدخول
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
											<th class="border-bottom-0" style="font-size: x-large">المحسن</th>
											<th class="border-bottom-0" style="font-size: x-large">الهاتف</th>
											<th class="border-bottom-0" style="font-size: x-large">المبلغ</th>
											<th class="border-bottom-0" style="font-size: x-large">التوجيه</th>
											<th class="border-bottom-0" style="font-size: x-large">التاريخ</th>
											<th class="border-bottom-0" style="font-size: x-large">الاجراءات</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($financialTransactions as $financialTransaction)
											<tr>
												<td>{{ $financialTransaction->id }}</td>
												<td>{{ $financialTransaction->donor->full_name }}</td>
												<td>{{ $financialTransaction->donor->phone }}</td>
												<td>{{ $financialTransaction->amount }}</td>
												<td>{{ $financialTransaction->orientation }}</td>
												<td>{{ $financialTransaction->transaction_date }}</td>
												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('financial_transactions.show', $financialTransaction->id) }}">عرض<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('financial_transactions.edit', $financialTransaction->id) }}">تعديل<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$financialTransaction->id}}">حذف<i class="las la-trash"></i></a>
												</td>
												<td></td>
											</tr>
											@include('financial_transactions.delete')
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

@endsection