@extends('dashboard.layouts.master')

@section('title')
	عناصر المساعدة

@endsection
@section('css')

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<link href="{{URL::asset('dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
		<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
		<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
		<link href="{{URL::asset('dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">عناصر المساعدة</h4>
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
								<a href="{{ route('assistance_items.create') }}" class="btn btn-primary" style="font-size: large">
									إضافة عنصر جديد
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
											<th class="border-bottom-0" style="font-size: x-large; width: 5%;">الرقم</th>
											<th class="border-bottom-0" style="font-size: x-large; width: 20%;">الاسم</th>
											<th class="border-bottom-0" style="font-size: x-large; width: 10%;">الكود</th>
											<th class="border-bottom-0" style="font-size: x-large; width: 15%;">الكمية</th>
											<th class="border-bottom-0" style="font-size: x-large; width: 15%;">تاريخ لإنشاء</th>
											<th class="border-bottom-0" style="font-size: x-large; width: 20%;">الاجراءات</th>
											<th class="border-bottom-0" style="font-size: x-large; width: 1%;"></th>
										</tr>
									</thead>
									<tbody>
										@foreach($assistance_items as $assistance_item)
											<tr>
												<td style="font-size: large">{{ $assistance_item->id }}</td>
												<td style="font-size: large">{{ $assistance_item->name }}</td>
												<td style="font-size: large">{{ $assistance_item->code }}</td>
												<td style="font-size: large">{{ $assistance_item->quantity_in_stock }}</td>
												<td style="font-size: large">{{ $assistance_item->created_at }}</td>
												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('assistance_items.show', $assistance_item->id) }}">عرض<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('assistance_items.edit', $assistance_item->id) }}">تعديل<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$assistance_item->id}}">حذف<i class="las la-trash"></i></a>
												</td>
												<td></td>
											</tr>
											@include('assistance_items.delete')
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