@extends('dashboard.layouts.master')

@section('title')
 المستفيدين

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto" style="font-size: xx-large"> المستفيدين</h4>
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
								<a href="{{ route('beneficiaries.create') }}" class="btn btn-primary" style="font-size: x-large">
									إضافة مستفيد
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
						<form method="GET" action="{{ route('beneficiaries.index') }}" class="mb-4">

							<div class="row" style="font-size: x-large">
								<div class="col">

								</div>

								<div class="col">
									<label>الدائرة</label>
									<select name="district_id" id="district" class="form-control">
										<option value="">الكل</option>
										@foreach($districts as $d)
											<option value="{{ $d->id }}">{{ $d->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="col">
									<label>البلدية</label>
									<select name="municipality_id" id="municipality" class="form-control">
										<option value="">الكل</option>
									</select>
								</div>

								<div class="col">
									<label>الحي</label>
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
										@foreach(['أرملة', 'مطلق', 'الدخل الضعيف', 'أرمل'] as $status)
											<option value="{{ $status }}" {{ request('social_status') == $status ? 'selected' : '' }} style="font-size: larger">
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
											<th class="border-bottom-0" style="font-size: x-large">النوع</th>
											<th class="border-bottom-0" style="font-size: x-large">تم الانشاء في</th>
											<th class="border-bottom-0" style="font-size: x-large">الاجراءات</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($beneficiaries as $beneficiary)
											<tr>
												<td>{{ $beneficiary->id }}</td>
												<td>{{ $beneficiary->beneficiary->full_name }}</td>
												<td>
													@if($benefice->type == 'financial')
														<span class="text-success"> طلب عيني</span>
													@else
														<span class="text-danger">طلب مالي</span>
													@endif
												</td>
												<td>{{ $benefice->created_at }}</td>

												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('benefices.show', $benefice->id) }}">عرض<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('benefices.edit', $benefice->id) }}">تعديل<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$benefice->id}}">حذف<i class="las la-trash"></i></a>
												</td>
												<td></td>
											</tr>
											@include('benefices.delete')
										@endforeach
									</tbody>
								</table>
								{{ $beneficiaries->links() }}
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		$('#district').on('change', function () {
			var districtId = $(this).val();

			// تفريغ البلديات السابقة
			$('#municipality').empty().append('<option value="">الكل</option>');

			if (districtId) {
				$.ajax({
					url: '/get-municipalities/' + districtId,
					type: 'GET',
					success: function (data) {
						$.each(data, function (key, municipality) {
							$('#municipality').append('<option value="' + municipality.id + '">' + municipality.name + '</option>');
						});
					}
				});
			}
		});
	</script>


@endsection