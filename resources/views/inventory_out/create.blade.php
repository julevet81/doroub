@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">تسجيل خارج من المخزون</h4>
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
							<form action="{{ route('inventory_transactions.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								{{-- ==================== اختيار الجهة ==================== --}}
								<div class="mb-3">
									<label class="form-label">الجهة المستفيدة</label>
									<select id="destination_type" name="destination_type" class="form-control" required>
										<option value="">-- اختر الجهة --</option>
										<option value="project">مشروع</option>
										<option value="family">عائلة مكفولة</option>
										<option value="other">أخرى</option>
									</select>
								</div>

								{{-- مشروع --}}
								<div class="mb-3 d-none" id="project_select">
									<label class="form-label">اختر المشروع</label>
									<select name="project_id" class="form-control">
										<option value="">-- اختر مشروع --</option>
										@foreach ($projects as $project)
											<option value="{{ $project->id }}">{{ $project->name }}</option>
										@endforeach
									</select>
								</div>

								{{-- عائلة --}}
								<div class="mb-3 d-none" id="family_select">
									<label class="form-label">اختر العائلة</label>
									<select name="family_id" class="form-control">
										<option value="">-- اختر عائلة --</option>
										@foreach ($families as $family)
											<option value="{{ $family->id }}">{{ $family->full_name }}</option>
										@endforeach
									</select>
								</div>

								{{-- جهة أخرى --}}
								<div class="mb-3 d-none" id="other_input">
									<label class="form-label">اكتب الجهة</label>
									<input type="text" name="other_destination" class="form-control" placeholder="أدخل الجهة يدوياً">
								</div>

								<hr>

								{{-- ==================== العناصر الخارجة ==================== --}}
								<h5>العناصر الخارجة</h5>

								<table class="table table-bordered" id="items_table">
									<thead>
										<tr>
											<th style="font-size: large">العنصر</th>
											<th style="font-size: large">الكمية</th>
											<th style="font-size: large">إزالة</th>
										</tr>
									</thead>
									<tbody>
										<tr style="font-size: large">
											<td>
												<select name="items[0][item_id]" class="form-control" required>
													<option value="">-- اختر عنصر --</option>
													@foreach ($items as $item)
														<option value="{{ $item->id }}">{{ $item->name }}</option>
													@endforeach
												</select>
											</td>
											<td>
												<input type="number" name="items[0][qty]" class="form-control" min="1" required>
											</td>
											<td class="text-center">
												<button type="button" class="btn btn-danger btn-sm removeRow">حذف</button>
											</td>
										</tr>
									</tbody>
								</table>

								<button type="button" class="btn btn-primary mb-3" id="addRow">
									+ إضافة عنصر آخر
								</button>

								{{-- وصف عام --}}
								<div class="mb-3">
									<label class="form-label">وصف الخروج</label>
									<textarea name="description" class="form-control" rows="3"></textarea>
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
		// إظهار الجهة حسب الاختيار
		document.getElementById('destination_type').addEventListener('change', function () {
			let type = this.value;

			document.getElementById('project_select').classList.add('d-none');
			document.getElementById('family_select').classList.add('d-none');
			document.getElementById('other_input').classList.add('d-none');

			if (type === 'project') {
				document.getElementById('project_select').classList.remove('d-none');
			}
			else if (type === 'family') {
				document.getElementById('family_select').classList.remove('d-none');
			}
			else if (type === 'other') {
				document.getElementById('other_input').classList.remove('d-none');
			}
		});

		// إضافة صف جديد للعناصر
		let rowIndex = 1;

		document.getElementById('addRow').addEventListener('click', function () {

			let table = document.querySelector('#items_table tbody');

			let row = `
				<tr>
					<td>
						<select name="items[${rowIndex}][item_id]" class="form-control" required>
							<option value="">-- اختر عنصر --</option>
							@foreach ($items as $item)
								<option value="{{ $item->id }}">{{ $item->name }}</option>
							@endforeach
						</select>
					</td>
					<td>
						<input type="number" name="items[${rowIndex}][qty]" class="form-control" min="1" required>
					</td>
					<td class="text-center">
						<button type="button" class="btn btn-danger btn-sm removeRow">حذف</button>
					</td>
				</tr>
			`;

			table.insertAdjacentHTML('beforeend', row);

			rowIndex++;
		});

		// حذف صف
		document.addEventListener('click', function (e) {
			if (e.target.classList.contains('removeRow')) {
				e.target.closest('tr').remove();
			}
		});
	</script>

@endsection