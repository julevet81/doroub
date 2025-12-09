@extends('dashboard.layouts.master')
@section('title')
    تفاصيل المتطوع
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto" style="font-size: x-large">تفاصيل المتطوع</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    <div class="container">
    <div>
        <h2>تفاصيل المتطوع</h2>
    </div>

    <table class="table table-bordered" style="font-size: x-large">
        <thead >
            <tr>
                <th style="font-size: x-large">المفتاح</th>
                <th style="font-size: x-large">القيمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($volunteerData as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    </div>
@endsection
@section('js')
@endsection