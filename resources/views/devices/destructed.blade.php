@extends('dashboard.layouts.master')

@section('title')
الاجهزة المتلفة

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto" style="font-size: x-large">الاجهزة المتلفة</h4>
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
						<thead class="text-center">
							<tr>
								<th class="border-bottom-0" style="font-size: x-large">الرقم</th>
								<th class="border-bottom-0" style="font-size: x-large">الاسم</th>
								<th class="border-bottom-0" style="font-size: x-large">الكود بار</th>
								<th class="border-bottom-0" style="font-size: x-large">رقم الجرد</th>
								<th class="border-bottom-0" style="font-size: x-large">الاجراءات </th>
								<th></th>
							</tr>
						</thead>
						<tbody style="font-size: x-large">
							@foreach($devices as $device)
							<tr>
								<td>{{ $device->id }}</td>
								<td>{{ $device->name }}</td>
								<td>{{ $device->barcode }}</td>
								<td>{{ $device->serial_number }}</td>
								<td>
									<a class="modal-effect btn btn-sm btn-success" href="{{ route('devices.show', $device->id) }}">عرض<i class="las la-pen"></i></a>
									<a class="modal-effect btn btn-sm btn-info" href="{{ route('devices.edit', $device->id) }}">تعديل<i class="las la-pen"></i></a>
									<a href="{{ route('devices.destruction.edit', $device->id) }}"
										class="btn btn-sm btn-primary">
										تقرير الإتلاف
									</a>
									<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-toggle="modal" href="#delete{{$device->id}}">حذف<i class="las la-trash"></i></a>
								</td>
								<td></td>
							</tr>
							@include('devices.delete')
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