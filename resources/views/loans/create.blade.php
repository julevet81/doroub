@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة طلب</h4>
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
							<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								<div class="row mb-3">
									<div class="col">
										<label for="beneficiary_id" class="form-label" style="font-size: x-large">المستفيد</label>
										<select name="beneficiary_id" id="beneficiary_id" class="form-control" required style="font-size: x-large">
											<option value="">اختر المستفيد</option>
											@foreach($beneficiaries as $beneficiary)
												<option value="{{ $beneficiary->id }}">{{ $beneficiary->full_name }}</option>
											@endforeach
										</select>
									</div>
									<div class="col">
										<label for="demand_date" class="form-label" style="font-size: x-large">تاريخ الطلب</label>
										<input type="date" name="demand_date" id="demand_date" class="form-control" required style="font-size: x-large">
									</div>
								</div>
								<hr>
								{{-- Attachment --}}
								<div class="col-md-6 mb-3">
									<label class="form-label">الملف المرفق</label>
									<input type="file" name="attachement" class="form-control" accept="image/*,.pdf">
								</div>
								<div id="items-container">
									<h4 style="font-size: x-large">عناصر المساعدة المطلوبة</h4>
									<div class="row mb-2 item-row">
										<div class="col">
											<select name="items[0][assistance_item_id]" class="form-control" required style="font-size: x-large">
												<option value="">اختر العنصر</option>
												@foreach($assistance_items as $item)
													<option value="{{ $item->id }}">{{ $item->name }}</option>
												@endforeach
											</select>
										</div>

										<div class="col">
											<input type="number" name="items[0][quantity]" class="form-control" min="1" placeholder="الكمية" required style="font-size: x-large">
										</div>

										<div class="col-auto">
											<button type="button" class="btn btn-danger remove-row">X</button>
										</div>
									</div>
								</div>
								<button type="button" class="btn btn-secondary mb-3" id="add-item" style="font-size: x-large">إضافة عنصر آخر</button>
								<br>
								<div class="mb-3">
									<label for="description" class="form-label" style="font-size: x-large">الوصف</label>
									<textarea name="description" id="description" class="form-control" rows="4" style="font-size: x-large"></textarea>
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