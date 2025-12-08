@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة استفادة</h4>
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
								<div class="row">
									<div class="col">
										<label for="type" class="form-label" style="font-size: x-large">نوع الاستفادة</label>
										<select name="type" id="type" class="form-control" required style="font-size: x-large">
											<option value="" disabled selected>اختر النوع</option>
											<option value="financial">مالية</option>
											<option value="material">عينية</option>
										</select>
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

@endsection