@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto" style="font-size: x-large">إضافة اعارة</h4>
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
							<form action="{{ route('loans.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								{{-- DEVICE --}}
								<div class="row mb-3">
									<div class="col">
										<label class="control-label">الجهاز</label>
										<select name="device_id" class="form-control" style="font-size: x-large" required>
											<option value="">اختر الجهاز</option>
											@foreach($devices as $device)
												<option value="{{ $device->id }}">{{ $device->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								{{-- BENEFICIARY TYPE --}}
								<div class="row mb-3">
									<div class="col">
										<label class="control-label">نوع المستفيد</label>
										<select id="beneficiary_type" class="form-control" style="font-size: x-large" required>
											<option value="" selected disabled>اختر النوع</option>
											<option value="existing">مستفيد مسجل</option>
											<option value="new">مستفيد جديد</option>
										</select>
									</div>
								</div>

								{{-- EXISTING BENEFICIARY --}}
								<div id="existing_beneficiary_section" style="display:none;">
									<div class="row mb-3">
										<div class="col">
											<label>اختر المستفيد المسجل</label>
											<select name="beneficiary_id" class="form-control" style="font-size: x-large">
												<option value="">اختر المستفيد</option>
												@foreach($beneficiaries as $b)
													<option value="{{ $b->id }}">{{ $b->full_name }} - {{ $b->barcode }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>

								{{-- NEW BENEFICIARY --}}
								<div id="new_beneficiary_section" style="display:none; border: 2px solid #ccc; padding: 15px; border-radius: 10px;">

									<h4>تسجيل مستفيد جديد</h4>

									<input type="hidden" name="new_beneficiary" value="1">

									<div class="row">
										<div class="col">
											<label>الاسم الكامل</label>
											<input type="text" name="full_name" class="form-control" required>
										</div>

										<div class="col">
											<label>تاريخ الميلاد</label>
											<input type="date" name="date_of_birth" class="form-control" required>
										</div>
									</div>

									<div class="row mt-3">
										<div class="col">
											<label>مكان الميلاد</label>
											<input type="text" name="place_of_birth" class="form-control" required>
										</div>

										<div class="col">
											<label>رقم الهاتف</label>
											<input type="text" name="phone_1" class="form-control">
										</div>
									</div>

									<div class="row mt-3">
										<div class="col">
											<label>الحالة الاجتماعية</label>
											<select name="social_status" class="form-control">
												<option value="single">أعزب</option>
												<option value="maried">متزوج</option>
												<option value="divorced">مطلق</option>
												<option value="widowed">أرمل</option>
											</select>
										</div>

										<div class="col">
											<label>الجنس</label>
											<select name="gender" class="form-control">
												<option value="male">ذكر</option>
												<option value="female">أنثى</option>
											</select>
										</div>
									</div>

									<div class="row mt-3">
										<div class="col">
											<label>الفئة</label>
											<select name="beneficiary_category_id" class="form-control">
												@foreach($categories as $c)
													<option value="{{ $c->id }}">{{ $c->name }}</option>
												@endforeach
											</select>
										</div>

										<div class="col">
											<label>البلدية</label>
											<select name="municipality_id" class="form-control">
												@foreach($municipalities as $m)
													<option value="{{ $m->id }}">{{ $m->name }}</option>
												@endforeach
											</select>
										</div>

										<div class="col">
											<label>الدائرة</label>
											<select name="district_id" class="form-control">
												@foreach($districts as $d)
													<option value="{{ $d->id }}">{{ $d->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

								</div>

								{{-- LOAN DATA --}}
								<hr>

								<div class="row mt-3">
									<div class="col">
										<label>تاريخ الإعارة</label>
										<input type="date" name="loan_date" class="form-control" style="font-size: x-large" required>
									</div>

									<div class="col">
										<label>الحالة</label>
										<select name="status" class="form-control" style="font-size: x-large" required>
											<option value="active">نشط</option>
											<option value="returned">تم إرجاعه</option>
										</select>
									</div>
								</div>

								<div class="row mt-3">
									<div class="col">
										<label>ملاحظات</label>
										<textarea name="notes" class="form-control" rows="3"></textarea>
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
	<script>
		document.getElementById('beneficiary_type').addEventListener('change', function () {
			let type = this.value;

			document.getElementById('existing_beneficiary_section').style.display =
				type === 'existing' ? 'block' : 'none';

			document.getElementById('new_beneficiary_section').style.display =
				type === 'new' ? 'block' : 'none';
		});
	</script>

@endsection