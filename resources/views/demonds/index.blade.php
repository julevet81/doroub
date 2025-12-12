@extends('dashboard.layouts.master')

@section('title')
 الطلبات

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto" style="font-size: xx-large"> الطلبات</h4>
			</div>
		</div>

	</div>

	<!-- /breadcrumb -->
@endsection
@section('content')
			<!-- row -->
			<div class="row row-sm">
				<!--div-->
				<div class="col-xl-12" style="font-size: x-large;">
					<div class="card mg-b-20">
						<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
								<!-- Button trigger modal -->
								<a href="{{ route('demonds.create') }}" class="btn btn-primary">
									إضافة طلب
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
											<th class="border-bottom-0" style="font-size: x-large">الاسم الكامل</th>
											<th class="border-bottom-0" style="font-size: x-large">تمت المعالجة من</th>
											<th class="border-bottom-0" style="font-size: x-large">تم الانشاء في</th>
											<th class="border-bottom-0" style="font-size: x-large">الاجراءات</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($demonds as $demond)
											<tr>
												<td>{{ $demond->id }}</td>
												<td>{{ $demond->beneficiary->full_name }}</td>
												<td>{{ $demond->treated_by }}</td>
												<td>{{ $demond->created_at }}</td>
												<td>
													@if($registration->status == 'accepted')
														<span class="text-success">موافق عليه</span>
													@elseif($registration->status == 'pending')
														<span class="text-warning">قيد المراجعة</span>
													@else
														<span class="text-danger">غير موافق عليه</span>
													@endif
												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('demonds.show', $demond->id) }}">عرض<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('demonds.edit', $demond->id) }}">تعديل<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$demond->id}}">حذف<i class="las la-trash"></i></a>
												</td>
												<td></td>
											</tr>
											@include('demonds.delete')
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