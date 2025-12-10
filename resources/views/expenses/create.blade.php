@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">إضافة نفقة</h4>
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
				<form action="{{ route('expenses.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col">
							<label for="out_orientation" class="control-label" style="font-size: x-large">التوجيه</label>
							<select name="out_orientation" id="out_orientation" class="form-control" style="font-size: x-large" required>
								<option value="" disabled selected>اختار التوجيه</option>
								<option value="project">المشروع</option>
								<option value="sponsored_family">عائلة مكفولة</option>
								<option value="services">حدمات مكتبية</option>
								<option value="electricity">مصاريف كهرباء</option>
								<option value="maintenance">مصاريف صيانة</option>
								<option value="internet">مصاريف انترنت</option>
								<option value="cleaning">مواد تنضيف</option>
								<option value="generals">مصاريف عامة</option>
							</select>
						</div>
						<div class="col">
							<label for="transaction_date" class="control-label" style="font-size: x-large">تاريخ الإضافة</label>
							<input type="date" name="transaction_date" id="transaction_date" class="form-control" style="font-size: x-large" required>
						</div>
					</div>

					<br>

					<div class="col" id="project-select-group" style="display:none;">
						<label for="project_id" class="control-label" style="font-size: x-large">اختر المشروع</label>
						<select name="project_id" id="project_id" class="form-control" style="font-size: x-large">
							<option value="" disabled selected>اختار المشروع</option>
							@foreach($projects as $project)
							<option value="{{ $project->id }}">{{ $project->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="col" id="beneficiary-select-group" style="display:none;">
						<label for="beneficiary_id" class="control-label" style="font-size: x-large">اختر العائلة المكفولة</label>
						<select name="beneficiary_id" id="beneficiary_id" class="form-control" style="font-size: x-large">
							<option value="" disabled selected>اختار العائلة</option>
							@foreach($beneficiaries as $beneficiary)
							<option value="{{ $beneficiary->id }}">{{ $beneficiary->full_name }}</option>
							@endforeach
						</select>
					</div>

					<br>

					<div class="col">
						<label for="amount" class="control-label" style="font-size: x-large">المبلغ</label>
						<input type="number" name="amount" id="amount" class="form-control" style="font-size: x-large" required>
					</div>

					<br>

					<div class="col">
						<label for="attachment" class="control-label" style="font-size: x-large">الفاتورة</label>
						<input type="file" name="attachment" id="attachment" class="form-control" style="font-size: x-large">
					</div>

					<br>

					<div class="col">
						<label for="notes" class="control-label" style="font-size: x-large">يصرف لأمر</label>
						<textarea name="notes" id="notes" class="form-control" style="font-size: x-large" rows="3"></textarea>
					</div>

					<br>


					<button type="submit" class="btn btn-primary" style="font-size: x-large">حفظ البيانات</button>
				</form>
			</div>
		</div>
	</div>
	<!-- row closed -->
</div>
<!-- Container closed -->

@endsection
@section('js')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const orientationSelect = document.getElementById('out_orientation');
		const projectGroup = document.getElementById('project-select-group');
		const beneficiaryGroup = document.getElementById('beneficiary-select-group');

		orientationSelect.addEventListener('change', function() {
			if (this.value === 'project') {
				projectGroup.style.display = 'block';
				beneficiaryGroup.style.display = 'none';
			} else if (this.value === 'sponsored_family') {
				beneficiaryGroup.style.display = 'block';
				projectGroup.style.display = 'none';
			} else {
				projectGroup.style.display = 'none';
				beneficiaryGroup.style.display = 'none';
			}
		});
	});
</script>

@endsection