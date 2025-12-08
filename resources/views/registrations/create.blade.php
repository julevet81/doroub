@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة مستخدم</h4>
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
								<div class="form-group">
									<label for="name" style="font-size: x-large">الاسم</label>
									<input type="text" name="name" id="name" class="form-control" required style="font-size: x-large">
								</div>
								<div class="form-group">
									<label for="email" style="font-size: x-large">البريد الإلكتروني</	label>
									<input type="email" name="email" id="email" class="form-control" required style="font-size: x-large">
								</div>
								<div class="form-group">
									<label for="phone" style="font-size: x-large">رقم الهاتف</label>
									<input type="text" name="phone" id="phone" class="form-control" required style="font-size: x-large">
								</div>
								<div class="form-group">
									<label for="address" style="font-size: x-large">العنوان</label>
									<input type="text" name="address" id="address" class="form-control" required style="font-size: x-large">
								</div>
								<div class="form-group">
									<label for="role_id" style="font-size: x-large">الدور</label>
									<select name="role_id" id="role_id" class="form-control" required style="font-size: x-large">
										<option value="" disabled selected>اختر الدور</option>
										@foreach($roles as $role)
											<option value="{{ $role->id }}">{{ $role->name }}</option>
										@endforeach

									</select>
								</div>
								<div class="form-group">
									<label for="password" style="font-size: x-large">كلمة المرور</label>
									<input type="password" name="password" id="password" class="form-control" required style="font-size: x-large">
								</div>
								<div class="form-group">
									<label for="password_confirmation" style="font-size: x-large">تأكيد كلمة المرور</label>
									<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required style="font-size: x-large">
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