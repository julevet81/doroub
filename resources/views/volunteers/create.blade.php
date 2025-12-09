@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة متطوع جديد</h4>
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
							<form action="{{ route('volunteers.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								{{-- Full Name --}}
								<div class="mb-3">
									<label class="form-label">الاسم الكامل</label>
									<input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
									@error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Membership ID --}}
								<div class="mb-3">
									<label class="form-label">رقم العضوية</label>
									<input type="text" name="membership_id" class="form-control" value="{{ old('membership_id') }}" required>
									@error('membership_id') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Gender --}}
								<div class="mb-3">
									<label class="form-label">الجنس</label>
									<select name="gender" class="form-control" required>
										<option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
										<option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
									</select>
									@error('gender') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Email --}}
								<div class="mb-3">
									<label class="form-label">البريد الإلكتروني</label>
									<input type="email" name="email" class="form-control" value="{{ old('email') }}">
									@error('email') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Phones --}}
								<div class="mb-3">
									<label class="form-label">الهاتف 1</label>
									<input type="text" name="phone_1" class="form-control" value="{{ old('phone_1') }}">
									@error('phone_1') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								<div class="mb-3">
									<label class="form-label">الهاتف 2</label>
									<input type="text" name="phone_2" class="form-control" value="{{ old('phone_2') }}">
									@error('phone_2') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Address --}}
								<div class="mb-3">
									<label class="form-label">العنوان</label>
									<input type="text" name="address" class="form-control" value="{{ old('address') }}">
									@error('address') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Date of Birth --}}
								<div class="mb-3">
									<label class="form-label">تاريخ الميلاد</label>
									<input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
									@error('date_of_birth') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- National ID --}}
								<div class="mb-3">
									<label class="form-label">الرقم الوطني</label>
									<input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}">
									@error('national_id') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Joining Date --}}
								<div class="mb-3">
									<label class="form-label">تاريخ الانضمام</label>
									<input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}">
									@error('joining_date') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Subscriptions --}}
								<div class="mb-3">
									<label class="form-label">الاشتراكات</label>
									<input type="number" name="subscriptions" class="form-control" value="{{ old('subscriptions') }}">
									@error('subscriptions') <small class="text-danger">{{ $message }}</small> @enderror
								</div>


								{{-- Skills --}}
								<div class="mb-3">
									<label class="form-label">المهارات</label>
									<input type="text" name="skills" class="form-control" value="{{ old('skills') }}">
									@error('skills') <small class="text-danger">{{ $message }}</small> @enderror
								</div>

								{{-- Study Level --}}
								<div class="mb-3">
									<label class="form-label">المستوى الدراسي</label>
									<select name="study_level" class="form-control" style="font-size: large">
										<option value="">اختر المستوى</option>
										<option value="primary" {{ old('study_level') == 'primary' ? 'selected' : '' }}>ابتدائي</option>
										<option value="intermediate" {{ old('study_level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
										<option value="secondary" {{ old('study_level') == 'secondary' ? 'selected' : '' }}>ثانوي</option>
										<option value="high_school" {{ old('study_level') == 'high_school' ? 'selected' : '' }}>ثانوية عامة</option>
										<option value="bachelor" {{ old('study_level') == 'bachelor' ? 'selected' : '' }}>بكالوريوس</option>
										<option value="master" {{ old('study_level') == 'master' ? 'selected' : '' }}>ماجستير</option>
										<option value="phd" {{ old('study_level') == 'phd' ? 'selected' : '' }}>دكتوراه</option>
										<option value="other" {{ old('study_level') == 'other' ? 'selected' : '' }}>أخرى</option>
									</select>
								</div>

								{{-- Grade --}}
								<div class="mb-3">
									<label class="form-label">الرتبة</label>
									<select name="grade" class="form-control" style="font-size: large">
										<option value="">اختر الرتبة</option>
										<option value="founder" {{ old('grade') == 'founder' ? 'selected' : '' }}>مؤسس</option>
										<option value="active" {{ old('grade') == 'active' ? 'selected' : '' }}>نشط</option>
										<option value="honorary" {{ old('grade') == 'honorary' ? 'selected' : '' }}>شرفي</option>
									</select>
								</div>

								{{-- Section --}}
								<div class="mb-3">
									<label class="form-label">القسم</label>
									<select name="section" class="form-control" style="font-size: large">
										<option value="">اختر القسم</option>
										<option value="planning" {{ old('section') == 'planning' ? 'selected' : '' }}>التخطيط</option>
										<option value="entry" {{ old('section') == 'entry' ? 'selected' : '' }}>الاستقبال</option>
										<option value="executive" {{ old('section') == 'executive' ? 'selected' : '' }}>تنفيذي</option>
										<option value="finance" {{ old('section') == 'finance' ? 'selected' : '' }}>المالية</option>
										<option value="management" {{ old('section') == 'management' ? 'selected' : '' }}>الإدارة</option>
										<option value="resources" {{ old('section') == 'resources' ? 'selected' : '' }}>الموارد</option>
										<option value="relations" {{ old('section') == 'relations' ? 'selected' : '' }}>العلاقات</option>
										<option value="media" {{ old('section') == 'media' ? 'selected' : '' }}>الإعلام</option>
										<option value="social" {{ old('section') == 'social' ? 'selected' : '' }}>الاجتماعي</option>
									</select>
								</div>

								{{-- Notes --}}
								<div class="mb-3">
									<label class="form-label">ملاحظات</label>
									<textarea name="notes" class="form-control"  style="font-size: large">{{ old('notes') }}</textarea>
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