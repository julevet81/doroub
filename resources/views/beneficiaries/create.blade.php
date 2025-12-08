@extends('dashboard.layouts.master')
@section('css')
	<style>
		form,
		table,
		input,
		select,
		label,
		button {
			font-size: 20px !important;
			/* تكبير الخط */
		}

		h4 {
			font-size: 24px;
			font-weight: bold;
		}
	</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة مستفيد</h4>
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
							<form action="{{ route('benefices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								{{-- ===== معلومات المستفيد ===== --}}
								<h4 class="mt-3 mb-2">معلومات المستفيد</h4>

								<div class="row mb-3">
									<div class="col">
										<label>الاسم الكامل</label>
										<input type="text" name="full_name" class="form-control" placeholder="أدخل الاسم الكامل" required>
									</div>

									<div class="col">
										<label>تاريخ الميلاد</label>
										<input type="date" name="date_of_birth" class="form-control">
									</div>

									<div class="col">
										<label>مكان الميلاد</label>
										<input type="text" name="place_of_birth" class="form-control" placeholder="مكان الميلاد">
									</div>
								</div>

								<div class="row mb-3">
									<div class="col">
										<label>العنوان</label>
										<input type="text" name="address" class="form-control" placeholder="العنوان">
									</div>

									<div class="col">
										<label>الهاتف 1</label>
										<input type="text" name="phone_1" class="form-control" placeholder="الهاتف 1">
									</div>

									<div class="col">
										<label>الهاتف 2</label>
										<input type="text" name="phone_2" class="form-control" placeholder="الهاتف 2">
									</div>
								</div>

								<div class="row mb-3">
									<div class="col">
										<label>رقم الهوية الوطنية</label>
										<input type="text" name="national_id" class="form-control" placeholder="رقم الهوية الوطنية">
									</div>

									<div class="col">
										<label>تحميل صورة الهوية</label>
										<input type="file" name="national_id_file" class="form-control">
									</div>
								</div>

								<hr>

								{{-- ===== معلومات الزوج/الزوجة ===== --}}
								<h4 class="mt-3 mb-2">معلومات الزوج / الزوجة</h4>

								<div class="row mb-3">
									<div class="col">
										<label>الاسم</label>
										<input type="text" name="partner[first_name]" class="form-control" placeholder="الاسم">
									</div>

									<div class="col">
										<label>اللقب</label>
										<input type="text" name="partner[last_name]" class="form-control" placeholder="اللقب">
									</div>

									<div class="col">
										<label>تاريخ الميلاد</label>
										<input type="date" name="partner[birth_date]" class="form-control">
									</div>

									<div class="col">
										<label>مكان الميلاد</label>
										<input type="text" name="partner[birth_place]" class="form-control" placeholder="مكان الميلاد">
									</div>
								</div>

								<div class="row mb-3">

									<div class="col">
										<label>المستوى الدراسي</label>
										<select name="partner[study_level]" class="form-control">
											<option value="">اختر</option>
											<option value="none">بدون</option>
											<option value="primary">ابتدائي</option>
											<option value="secondary">ثانوي</option>
											<option value="higher">جامعي</option>
										</select>
									</div>

									<div class="col">
										<label>المهنة</label>
										<input type="text" name="partner[job]" class="form-control" placeholder="المهنة">
									</div>

									<div class="col">
										<label>مصدر الدخل</label>
										<input type="text" name="partner[income_source]" class="form-control" placeholder="مصدر الدخل">
									</div>

									<div class="col">
										<label>التأمين</label>
										<select name="partner[insured]" class="form-control">
											<option value="0">لا</option>
											<option value="1">نعم</option>
										</select>
									</div>

								</div>

								<hr>

								

								<hr>
								<h4 class="mt-3 mb-2">الأطفال غير البالغين</h4>

								<table class="table table-bordered text-center" id="kids-table" dir="rtl">
									<thead>
										<tr>
											<th>الاسم الكامل</th>
											<th>تاريخ الميلاد</th>
											<th>الجنس</th>
											<th>المستوى الدراسي</th>
											<th>المؤسسة التعليمية</th>
											<th>إزالة</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>

								<button type="button" class="btn btn-sm btn-info mb-3" id="add-kid">
									+ إضافة طفل غير بالغ
								</button>

								<hr>

								<h4 class="mt-3 mb-2">الأطفال البالغين</h4>

								<table class="table table-bordered text-center" id="adults-table" dir="rtl">
									<thead>
										<tr>
											<th>الاسم الكامل</th>
											<th>تاريخ الميلاد</th>
											<th>الجنس</th>
											<th>المهنة</th>
											<th>ملاحظة</th>
											<th>إزالة</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>

								<button type="button" class="btn btn-sm btn-info mb-3" id="add-adult">
									+ إضافة طفل بالغ
								</button>

								<hr>


								<button type="button" class="btn btn-sm btn-info mb-3" id="add-child">
									+ إضافة طفل
								</button>


								<hr>
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
		let kidIndex = 0;
		let adultIndex = 0;

		// ------------- الأطفال غير البالغين --------------
		document.getElementById('add-kid').addEventListener('click', function () {

			let row = `
			<tr>
				<td><input type="text" name="children[kids][${kidIndex}][full_name]" class="form-control"></td>
				<td><input type="date" name="children[kids][${kidIndex}][date_of_birth]" class="form-control"></td>

				<td>
					<select name="children[kids][${kidIndex}][gender]" class="form-control">
						<option value="">اختر</option>
						<option value="male">ذكر</option>
						<option value="female">أنثى</option>
					</select>
				</td>

				<td>
					<select name="children[kids][${kidIndex}][study_level]" class="form-control">
						<option value="">اختر</option>
						<option value="none">بدون</option>
						<option value="primary">ابتدائي</option>
						<option value="secondary">ثانوي</option>
						<option value="higher">جامعي</option>
					</select>
				</td>

				<td><input type="text" name="children[kids][${kidIndex}][school]" class="form-control"></td>

				<td>
					<button type="button" class="btn btn-danger btn-sm remove-row">حذف</button>
				</td>
			</tr>
			`;

			document.querySelector('#kids-table tbody').insertAdjacentHTML('beforeend', row);
			kidIndex++;
		});

		// ------------- الأطفال البالغين --------------
		document.getElementById('add-adult').addEventListener('click', function () {

			let row = `
			<tr>
				<td><input type="text" name="children[adults][${adultIndex}][full_name]" class="form-control"></td>
				<td><input type="date" name="children[adults][${adultIndex}][date_of_birth]" class="form-control"></td>

				<td>
					<select name="children[adults][${adultIndex}][gender]" class="form-control">
						<option value="">اختر</option>
						<option value="male">ذكر</option>
						<option value="female">أنثى</option>
					</select>
				</td>

				<td><input type="text" name="children[adults][${adultIndex}][job]" class="form-control" placeholder="المهنة"></td>

				<td><input type="text" name="children[adults][${adultIndex}][notes]" class="form-control" placeholder="ملاحظات"></td>

				<td>
					<button type="button" class="btn btn-danger btn-sm remove-row">حذف</button>
				</td>
			</tr>
			`;

			document.querySelector('#adults-table tbody').insertAdjacentHTML('beforeend', row);
			adultIndex++;
		});

		// -------- حذف الصف لأية من الجدولين --------
		document.body.addEventListener('click', function (e) {
			if (e.target.classList.contains('remove-row')) {
				e.target.closest('tr').remove();
			}
		});
	</script>



@endsection