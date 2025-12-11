@extends('dashboard.layouts.master')

@section('title')
المشاريع

@endsection
@section('css')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
	<!-- Maps css -->
	<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">المشاريع</h4>
		</div>
	</div>

</div>

<!-- /breadcrumb -->
@endsection
@section('content')
	
		<!--div-->
		<div class="row row-sm">
			<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
				<div class="card overflow-hidden sales-card bg-primary-gradient">
					<div class="pl-3 pr-3 pb-2 pt-0">
						<br>
						<div class="">
							<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">اجمالي المنجزة</h6>
						</div>
						<div class="pb-0 mt-0">
							<div class="d-flex">
								<div class="">
									<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Volunteer::count() }}</h4>
									<p class="mb-0 tx-12 text-white op-7">مقارنة بالشهر الماضي</p>
								</div>
								<span class="float-right my-auto mr-auto">
									<i class="fas fa-arrow-circle-up text-white"></i>
									<span class="text-white op-7"> +427</span>
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
							<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">إجمالي الملغاة</h6>
						</div>
						<div class="pb-0 mt-0">
							<div class="d-flex">
								<div class="">
									<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Beneficiary::count() }}
									</h4>
									<p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
								</div>
								<span class="float-right my-auto mr-auto">
									<i class="fas fa-arrow-circle-down text-white"></i>
									<span class="text-white op-7"> -23.09%</span>
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
							<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">إجمالي النشطة</h6>
						</div>
						<div class="pb-0 mt-0">
							<div class="d-flex">
								<div class="">
									<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Donor::count() }}</h4>
									<p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
								</div>
								<span class="float-right my-auto mr-auto">
									<i class="fas fa-arrow-circle-up text-white"></i>
									<span class="text-white op-7"> 52.09%</span>
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
							<h6 class="mb-3 tx-12 text-white" style="font-size: x-large">إجمالي المحطط لها</h6>
						</div>
						<div class="pb-0 mt-0">
							<div class="d-flex">
								<div class="">
									<h4 class="tx-20 font-weight-bold mb-1 text-white">َ{{ App\Models\Benefice::count() }}</h4>
									<p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
								</div>
								<span class="float-right my-auto mr-auto">
									<i class="fas fa-arrow-circle-down text-white"></i>
									<span class="text-white op-7"> -152.3</span>
								</span>
							</div>
						</div>
					</div>
					<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
				</div>
			</div>
		</div>
		
		<div class="col-xl-12">
			<div class="card mg-b-20">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<!-- Button trigger modal -->
						<a href="{{ route('projects.create') }}" class="btn btn-primary">
							إضافة مشروع جديد
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
									<th class="border-bottom-0" style="font-size: large">الرقم</th>
									<th class="border-bottom-0" style="font-size: large">الاسم</th>
									<th class="border-bottom-0" style="font-size: large">النوع</th>
									<th class="border-bottom-0" style="font-size: large">الحالة</th>
									<th class="border-bottom-0" style="font-size: large">تاريخ البدء</th>
									<th class="border-bottom-0" style="font-size: large">تاريخ الانتهاء</th>
									<th class="border-bottom-0" style="font-size: large">السعر</th>
									<th class="border-bottom-0" style="font-size: large">الاجراءات</th>
								</tr>
							</thead>
							<tbody style="font-size: large;">
								@foreach($projects as $project)
								<tr>
									<td>{{ $project->id }}</td>
									<td>{{ $project->name }}</td>
									<td>{{ $project->type }}</td>
									<td>
										@if($project->status == 'planned') 
											<span class="text-info">مخطط</span>
										@elseif($project->status == 'in_progress')
											<span class="text-warning">قيد التنفيذ</span>
										@elseif($project->status == 'completed')
											<span class="text-success">مكتمل</span>
										@elseif($project->status == 'rejected')
											<span class="text-danger"> مرفوض</span>
										@endif
									</td>
									<td>{{ $project->start_date }}</td>
									<td>{{ $project->end_date }}</td>
									<td>{{ $project->budget }}</td>
									<td>
										<a class="modal-effect btn btn-sm btn-success" href="{{ route('projects.show', $project->id) }}">عرض<i class="las la-pen"></i></a>
										<a class="modal-effect btn btn-sm btn-info" href="{{ route('projects.edit', $project->id) }}">تعديل<i class="las la-pen"></i></a>
										<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-toggle="modal" href="#delete{{$project->id}}">حذف<i class="las la-trash"></i></a>
									</td>
								</tr>
								@include('projects.delete')
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
	<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
	<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
	<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
	<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
	<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
	<script src="{{URL::asset('assets/js/index.js')}}"></script>
	<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

@endsection