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
									<div class="col">
										<label for="project_name" class="control-label">اسم المشروع</label>
										<input type="text" class="form-control" id="project_name" name="project_name" required>
									</div>
									<div class="col">
										<label for="project_type" class="control-label">نوع المشروع</label>
										<input type="text" class="form-control" id="project_type" name="project_type" required>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<label for="start_date" class="control-label">تاريخ البدء</label>
										<input type="date" class="form-control" id="start_date" name="start_date" required>
									</div>
									<div class="col">
										<label for="end_date" class="control-label">تاريخ الانتهاء</label>
										<input type="date" class="form-control" id="end_date" name="end_date" required>
									</div>
								</div>
								<div class="row" >
									<div class="col" >
										<label for="project_status" class="control-label" style="font-size: x-large">حالة المشروع</label>
										<select class="form-control" style="font-size: x-large" id="project_status" name="project_status" required >
											<option value="planned">مخطط</option>
											<option value="in_progress">قيد التنفيذ</option>
											<option value="completed">مكتمل</option>
											<option value="rejected" >ملغي</option>
										</select>
									</div>
								</div>
								<hr>

								<h5>الأصناف الداخلة</h5>
								<table class="table" id="itemsTable">
									<thead>
										<tr>
											<th style="font-size: large">الصنف</th>
											<th style="font-size: large">الكمية</th>
											<th style="font-size: large">إجراءات</th>
										</tr>
									</thead>
									<tbody>

										<tr>
											<td>
												<select name="items[0][item_id]" class="form-control">
													@foreach($items as $item)
														<option value="{{ $item->id }}">{{ $item->name }}</option>
													@endforeach
												</select>
											</td>

											<td>
												<input type="number" name="items[0][quantity]" class="form-control" min="1" required>
											</td>

											<td>
												<button type="button" class="btn btn-danger removeRow">حذف</button>
											</td>
										</tr>

									</tbody>
								</table>
								<div class="row">
									<div class="col">
										<label for="budget" class="control-label">السعر</label>
										<input type="number" class="form-control" id="budget" name="budget" required>
									</div>
								</div><br>

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
		let rowIndex = 1;

		document.getElementById('addRow').addEventListener('click', function () {

			let tableBody = document.querySelector('#itemsTable tbody');

			let newRow = `
				<tr>
					<td>
						<select name="items[${rowIndex}][item_id]" class="form-control">
							@foreach($items as $item)
								<option value="{{ $item->id }}">{{ $item->name }}</option>
							@endforeach
						</select>
					</td>

					<td>
						<input type="number" name="items[${rowIndex}][quantity]" class="form-control" min="1" required>
					</td>

					<td>
						<button type="button" class="btn btn-danger removeRow">حذف</button>
					</td>
				</tr>
			`;

			tableBody.insertAdjacentHTML('beforeend', newRow);
			rowIndex++;
		});

		// حذف الصف
		document.addEventListener('click', function (e) {
			if (e.target && e.target.classList.contains('removeRow')) {
				e.target.closest('tr').remove();
			}
		});
	</script>

@endsection