@extends('dashboard.layouts.master')
@section('title')
    تفاصيل العنصر
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto" style="font-size: x-large">تفاصيل العنصر</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
	<div class="container">
    <div>
		<h2>
            تفاصيل العنصر
        </h2>
	</div>

	<table class="table table-bordered">
        <thead>
            <tr>
                <th style="font-size: large">المفتاح</th>
                <th style="font-size: large">القيمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assistance_item as $key => $value)
                <tr>
                    <td style="font-size: large">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                    <td style="font-size: large">{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
@endsection
@section('js')
@endsection