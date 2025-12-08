@extends('dashboard.layouts.master')

@section('title')
 التسجيلات

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto"> التسجيلات</h4>
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
								<a href="{{ route('registrations.create') }}" class="btn btn-primary">
									إضافة تسجيل
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
						<form method="GET" action="{{ route('registrations.index') }}" class="mb-4">

							<div class="row" style="font-size: large">
								<div class="col">

								</div>

								<div class="col">
									<label>البلدية</label>
									<select name="municipality_id" class="form-control">
										<option value="">الكل</option>
										@foreach($municipalities as $m)
											<option value="{{ $m->id }}" {{ request('municipality_id') == $m->id ? 'selected' : '' }}>
												{{ $m->name }}
											</option>
										@endforeach
									</select>
								</div>

								<div class="col">
									<label>الدائرة</label>
									<select name="district_id" class="form-control">
										<option value="">الكل</option>
										@foreach($districts as $d)
											<option value="{{ $d->id }}" {{ request('district_id') == $d->id ? 'selected' : '' }}>
												{{ $d->name }}
											</option>
										@endforeach
									</select>
								</div>

								<div class="col">
									<label>المدينة</label>
									<input type="text" name="city" class="form-control" value="{{ request('city') }}">
								</div>

								<div class="col">
									<label>عدد أفراد العائلة</label>
									<input type="number" name="nbr_in_family" class="form-control" value="{{ request('nbr_in_family') }}">
								</div>

								<div class="col">
									<label>الحالة الاجتماعية</label>
									<select name="social_status" class="form-control">
										<option value="">الكل</option>
										@foreach(['maried', 'single', 'divorced', 'widowed'] as $status)
											<option value="{{ $status }}" {{ request('social_status') == $status ? 'selected' : '' }}>
												{{ $status }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col"></div>

							</div>
						</form>

						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table key-buttons text-md-nowrap">
									<thead>
										<tr>
											<th class="border-bottom-0" style="font-size: x-large">الرقم</th>
											<th class="border-bottom-0" style="font-size: x-large">الاسم الكامل</th>
											<th class="border-bottom-0" style="font-size: x-large">الهاتف</th>
											<th class="border-bottom-0" style="font-size: x-large">الحي</th>
											<th class="border-bottom-0" style="font-size: x-large">حالة الموافقة</th>
											<th class="border-bottom-0" style="font-size: x-large">الاجراءات</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($registrations as $registration)
											<tr>
												<td>{{ $registration->id }}</td>
												<td>{{ $registration->beneficiary->full_name }}</td>
												<td>{{ $registration->beneficiary->phone_1 }}</td>
												<td>{{ $registration->beneficiary->neighborhood }}</td>
												<td>
													@if($registration->status == 'accepted')
														<span class="text-success">موافق عليه</span>
													@elseif($registration->status == 'pending')
														<span class="text-warning">قيد المراجعة</span>
													@else
														<span class="text-danger">غير موافق عليه</span>
													@endif
												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('users.show', $user->id) }}">عرض<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('users.edit', $user->id) }}">تعديل<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$user->id}}">حذف<i class="las la-trash"></i></a>
												</td>
												<td></td>
											</tr>
											@include('users.delete')
										@endforeach
									</tbody>
								</table>
								{{ $registrations->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
	<!-- Container closed -->
@endsection
@section('js')
	<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
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