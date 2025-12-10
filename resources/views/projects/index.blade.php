@extends('dashboard.layouts.master')

@section('title')
المشاريع

@endsection
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
<!-- row -->
<div class="row row-sm">
	<!--div-->
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
								<td>{{ $project->created_at }}</td>
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

@endsection