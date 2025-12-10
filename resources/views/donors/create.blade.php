@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة مشروع جديد</h4>
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
							<form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								<div class="row">

									{{-- Full Name --}}
									<div class="col-md-6 mb-3">
										<label class="form-label">الاسم الكامل</label>
										<input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
										@error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
									</div>

									{{-- Activity --}}
									<div class="col-md-6 mb-3">
										<label class="form-label">النشاط (فريد)</label>
										<input type="text" name="activity" class="form-control" value="{{ old('activity') }}" required>
										@error('activity') <small class="text-danger">{{ $message }}</small> @enderror
									</div>

									{{-- Phone --}}
									<div class="col-md-6 mb-3">
										<label class="form-label">رقم الهاتف</label>
										<input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
										@error('phone') <small class="text-danger">{{ $message }}</small> @enderror
									</div>

									{{-- Assistance Category --}}
									<div class="col-md-6 mb-3">
										<label class="form-label">فئة المساعدة</label>
										<select name="assistance_category_id" class="form-control" required>
											<option value="">-- اختر الفئة --</option>

											@foreach($assistanceCategories as $cat)
												<option value="{{ $cat->id }}" {{ old('assistance_category_id') == $cat->id ? 'selected' : '' }}>
													{{ $cat->name }}
												</option>
											@endforeach
										</select>
										@error('assistance_category_id') <small class="text-danger">{{ $message }}</small> @enderror
									</div>

									{{-- Description --}}
									<div class="col-12 mb-3">
										<label class="form-label">الوصف</label>
										<textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
										@error('description') <small class="text-danger">{{ $message }}</small> @enderror
									</div>

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