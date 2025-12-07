@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إضافة عنصر مساعدة جديد</h4>
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
							<form action="{{ route('assistance_items.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
								@csrf
								<div class="row">
									<div class="col">
										<label for="name" class="control-label" style="font-size: x-large">اسم عنصر المساعدة</label>
										<input type="text" class="form-control" id="name" name="name" title="يرجى إدخال اسم عنصر المساعدة" required>
									</div>
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
@endsection