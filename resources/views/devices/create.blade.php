@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة جهاز جديد</h4>
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
							<form action="{{ route('devices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								{{-- Device Name --}}
								<div class="mb-3">
									<label class="form-label" style="font-size: large">اسم الجهاز</label>
									<input type="text" name="name" class="form-control" required>
									@error('name') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Serial Number --}}
								<div class="mb-3">
									<label class="form-label" style="font-size: large">الرقم التسلسلي</label>
									<input type="text" name="serial_number" class="form-control" required>
									@error('serial_number') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Is New --}}
								<div class="mb-3">
									<label class="form-label">هل الجهاز جديد؟</label>
									<select name="is_new" class="form-control" required>
										<option value="1" {{ old('is_new') == 1 ? 'selected' : '' }}>نعم</option>
										<option value="0" {{ old('is_new') == 0 ? 'selected' : '' }}>لا</option>
									</select>
									@error('is_new') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								<button type="submit" class="btn btn-primary" style="font-size: x-large">حفظ البيانات</button>
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