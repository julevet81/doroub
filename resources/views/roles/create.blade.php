@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة مستخدم</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
			<!-- row -->
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="card" style="font-size: x-large">
						<div class="card-body">
							<form action="{{ route('roles.store') }}" method="POST">
								@csrf

								<div class="form-group mb-3">
									<label>اسم الدور</label>
									<input type="text" name="name" class="form-control" required>
								</div>
								<div class="form-group mb-3">
									<label>الوصف</label>
									<textarea name="description" class="form-control" rows="3"></textarea>
								</div>

								<h4>الصلاحيات</h4>

								<div class="row">
									@foreach($permissions as $permission)
										<div class="col-md-3">
											<label>
												<input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
												{{ $permission->name }}
											</label>
										</div>
									@endforeach
								</div>
								

								<button class="btn btn-primary mt-3">حفظ</button>

							</form>

						</div>
					</div>
			</div>
			<!-- row closed -->
		</div>
		<!-- Container closed -->
	</div>
	<!-- main-content closed -->
@endsection
@section('js')

@endsection