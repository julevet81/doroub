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
										<label for="out_orientation"class="control-label" style="font-size: x-large">التوجيه</label>
										<select name="out_orientation" id="out_orientation" class="form-control" style="font-size: x-large" required>
											<option value="" disabled selected>اختار التوجيه</option>
											<option value="project">المشروع</option>
											<option value="sponsored_family">المخزون</option>
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
									</div></div>
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
	</div>
	<!-- main-content closed -->
@endsection
@section('js')
	{{-- <script>
		let index = 1;

		document.getElementById('add-item').addEventListener('click', function () {
			let container = document.getElementById('items-container');

			let row = `
			<div class="row mb-2 item-row">
				<div class="col">
					<select name="items[${index}][assistance_item_id]" class="form-control" required style="font-size: x-large">
						<option value="">اختر العنصر</option>
						@foreach($assistance_items as $item)
							<option value="{{ $item->id }}">{{ $item->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="col">
					<input type="number" name="items[${index}][quantity]" class="form-control" min="1" placeholder="الكمية" required style="font-size: x-large">
				</div>

				<div class="col-auto">
					<button type="button" class="btn btn-danger remove-row">X</button>
				</div>
			</div>
			`;

			container.insertAdjacentHTML('beforeend', row);
			index++;
		});

		document.addEventListener('click', function (e) {
			if (e.target.classList.contains('remove-row')) {
				e.target.closest('.item-row').remove();
			}
		});
	</script> --}}

@endsection