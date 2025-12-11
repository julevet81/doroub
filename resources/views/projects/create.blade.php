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
							<form action="{{ route('projects.store') }}" 			method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								<div class="card mb-4 p-3">
									<h4>بيانات المشروع</h4>

									<div class="row">
										<div class="col-md-6">
											<label>اسم المشروع</label>
											<input type="text" name="name" class="form-control" required>
										</div>

										<div class="col-md-6">
											<label>نوع المشروع</label>
											<input type="text" name="type" class="form-control" required>
										</div>

										<div class="col-md-4 mt-3">
											<label>تاريخ البدء</label>
											<input type="date" name="start_date" class="form-control" required>
										</div>

										<div class="col-md-4 mt-3">
											<label>تاريخ الانتهاء</label>
											<input type="date" name="end_date" class="form-control">
										</div>

										<div class="col-md-4 mt-3">
											<label>المبلغ</label>
											<input type="number" name="amount" class="form-control">
										</div>

										<div class="col-md-4 mt-3">
											<label>الحالة</label>
											<select name="status" class="form-control" required>
												<option value="planned">مخطط</option>
												<option value="in_progress">قيد التنفيذ</option>
												<option value="completed">مكتمل</option>
												<option value="rejected">مرفوض</option>
											</select>
										</div>

										<div class="col-12 mt-3">
											<label>ملاحظات</label>
											<textarea name="notes" class="form-control"></textarea>
										</div>
									</div>
								</div>

								<!-- عناصر المساعدة -->
								<div class="card p-3 mb-4">
									<h4>عناصر المساعدة</h4>

									<div id="items-container"></div>

									<button type="button" class="btn btn-primary mt-3" onclick="addItem()">إضافة عنصر</button>
								</div>

								<!-- المتطوعين -->
								<div class="card p-3 mb-4">
									<h4>فريق المتطوعين</h4>

									<div id="volunteers-container"></div>

									<button type="button" class="btn btn-success mt-3" onclick="addVolunteer()">إضافة متطوع</button>
								</div>
								<div class="form-group mb-3">
									<label>الوصف</label>
									<textarea name="description" class="form-control" rows="3"></textarea>
								</div>

								<button type="submit" class="btn btn-success btn-lg">حفظ المشروع</button>
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
		let items = @json($assistanceItems);
		let volunteers = @json($volunteers);

		// إضافة عنصر مساعدة
		function addItem() {
			let index = document.querySelectorAll('.item-row').length;

			let html = `
			<div class="row item-row mt-2 border p-2 rounded">
				<div class="col-md-5">
					<label>اسم العنصر</label>
					<select name="items[${index}][item_id]" class="form-control" onchange="updateStock(this, ${index})" required>
						<option value="">اختر</option>
						${items.map(i => `<option value="${i.id}" data-stock="${i.quantity_in_stock}">${i.name}</option>`).join('')}
					</select>
				</div>

				<div class="col-md-3">
					<label>الكمية</label>
					<input type="number" name="items[${index}][quantity]" class="form-control" min="1" required>
				</div>

				<div class="col-md-3">
					<label>المتبقي في المخزن</label>
					<input type="text" id="stock-${index}" class="form-control" disabled>
				</div>

				<div class="col-md-1 d-flex align-items-end">
					<button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
				</div>
			</div>
		`;

			document.getElementById('items-container').insertAdjacentHTML('beforeend', html);
		}

		// تحديث كمية المخزون المتبقية
		function updateStock(select, index) {
			let stock = select.options[select.selectedIndex].dataset.stock;
			document.getElementById('stock-' + index).value = stock;
		}

		// إضافة متطوع
		function addVolunteer() {
			let index = document.querySelectorAll('.vol-row').length;

			let html = `
			<div class="row vol-row mt-2 border p-2 rounded">
				<div class="col-md-5">
					<label>اسم المتطوع</label>
					<select name="volunteers[${index}][id]" class="form-control" required>
						<option value="">اختر</option>
						${volunteers.map(v => `<option value="${v.id}">${v.full_name} (${v.membership_id})</option>`).join('')}
					</select>
				</div>

				<div class="col-md-5">
					<label>المنصب في المشروع</label>
					<input type="text" name="volunteers[${index}][position]" class="form-control">
				</div>

				<div class="col-md-2 d-flex align-items-end">
					<button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">X</button>
				</div>
			</div>`;

			document.getElementById('volunteers-container').insertAdjacentHTML('beforeend', html);
		}
	</script>

@endsection