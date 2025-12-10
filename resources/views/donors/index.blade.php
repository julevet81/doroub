@extends('dashboard.layouts.master')

@section('title')
	المتبرعين

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">المتبرعين</h4>
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
								<a href="{{ route('donors.create') }}" class="btn btn-primary">
									إضافة متبرع جديد
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
											<th class="border-bottom-0" style="font-size: x-large">الاسم</th>
											<th class="border-bottom-0" style="font-size: x-large">النوع</th>
											<th class="border-bottom-0" style="font-size: x-large">الحالة</th>
											<th class="border-bottom-0" style="font-size: x-large">تاريخ البدء</th>
											<th class="border-bottom-0" style="font-size: x-large">تاريخ الانتهاء</th>
											<th class="border-bottom-0" style="font-size: x-large">السعر</th>
											<th class="border-bottom-0" style="font-size: x-large">الاجراءات</th>
										</tr>
									</thead>
									<tbody>
										@foreach($donors as $donor)
											<tr>
												<td>{{ $donor->id }}</td>
												<td>{{ $donor->name }}</td>
												<td>{{ $donor->type }}</td>
												<td>{{ $donor->status }}</td>
												<td>{{ $donor->start_date }}</td>
												<td>{{ $donor->end_date }}</td>
												<td>{{ $donor->budget }}</td>
												<td>{{ $donor->created_at }}</td>
												<td>
													<a class="modal-effect btn btn-sm btn-success" href="{{ route('donors.show', $donor->id) }}">عرض<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info"  href="{{ route('donors.edit', $donor->id) }}">تعديل<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$donor->id}}">حذف<i class="las la-trash"></i></a>
												</td>
											</tr>
											@include('donors.delete')
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

@endsection