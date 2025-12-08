@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة إلى المخزون</h4>
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
								<div class="row">
									<div class="col-12">
										<label style="font-size: x-large">العناصر</label>

										<div id="items-container">

											<div class="row mb-2 item-row">
												<div class="col">
													<select name="items[0][assistance_item_id]" class="form-control" required
														style="font-size: x-large">
														<option value="">اختر العنصر</option>
														@foreach($assistance_items as $item)
															<option value="{{ $item->id }}">{{ $item->name }}</option>
														@endforeach
													</select>
												</div>

												<div class="col">
													<input type="number" name="items[0][quantity]" class="form-control" placeholder="الكمية" min="1"
														required style="font-size: x-large">
												</div>

												<div class="col-auto">
													<button type="button" class="btn btn-danger remove-row">X</button>
												</div>
											</div>

										</div>

										<button type="button" id="add-item" class="btn btn-success" style="font-size: x-large">إضافة عنصر آخر</button>
									</div>
								</div>

								<br>
								<div class="row">
									<div class="col">
										<label for="orientation" class="control-label" style="font-size: x-large">التوجيه</label>
										<select name="orientation" id="orientation" class="form-control" style="font-size: x-large" required>
											<option value="" disabled selected>اختار التوجيه</option>
											<option value="project">مشروع</option>
											<option value="inventory">مخزون</option>
										</select>
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
	</script>

@endsection