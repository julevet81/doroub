@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">إضافة معاملة مالية</h4>
		</div>
	</div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="card" style="font-size: large">
			<div class="card-body">
				<form action="{{ route('inventory_transactions.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col">
							<label for="donor_id" class="control-label" style="font-size: x-large">المتبرع</label>
							<select name="donor_id" id="donor_id" class="form-control" style="font-size: x-large">
								<option value="">اختر المتبرع</option>
								@foreach($donors as $donor)
								<option value="{{ $donor->id }}">{{ $donor->full_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col">
							<label for="transaction_date" class="control-label" style="font-size: x-large">تاريخ الإضافة</label>
							<input type="date" name="transaction_date" id="transaction_date" class="form-control" style="font-size: x-large" required>
						</div>
					</div>
					<br>
					<div class="form-group" style="font-size: x-large;">
						<label>التوجيه</label>
						<select name="orientation" id="orientation" class="form-control">
							<option value="">-- اختر التوجيه --</option>
							<option value="project">المشروع</option>
							<option value="other">الخزينة</option>
						</select>
					</div>

					<div class="form-group" id="project-select-group" style="display:none;">
						<label>المشروع</label>
						<select name="project_id" class="form-control">
							<option value="">-- اختر المشروع --</option>
							@foreach($projects as $project)
							<option value="{{ $project->id }}">{{ $project->name }}</option>
							@endforeach
						</select>
					</div>



					<br>
					<div class="row">
						<div class="col">
							<label for="amount" class="control-label" style="font-size: x-large">المبلغ</label>
							<input type="number" name="amount" id="amount" class="form-control" style="font-size: x-large" required>
						</div>
						<div class="col">
							<label for="notes" class="control-label" style="font-size: x-large">ملاحظات</label>
							<textarea name="notes" id="notes" class="form-control" style="font-size: x-large" rows="3"></textarea>
						</div>
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
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const orientationSelect = document.getElementById('orientation');
		const projectGroup = document.getElementById('project-select-group');

		orientationSelect.addEventListener('change', function() {
			if (this.value === 'project') {
				projectGroup.style.display = 'block';
			} else {
				projectGroup.style.display = 'none';
			}
		});
	});
</script>

@endsection