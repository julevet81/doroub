@extends('dashboard.layouts.master')
@section('title')
    تفاصيل المشروع
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto" style="font-size: x-large">تفاصيل المشروع</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
	<div class="container">
    <div>
		<h2>تفاصيل المشروع</h2>
	</div>

	<table class="table table-bordered">
        <thead>
            <tr>
                <th>المفتاح</th>
                <th>القيمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projectData as $key => $value)
                <tr style="font-size: large">
                    <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br> 
    <a href="{{ route('projects.index') }}" class="btn btn-primary">رجوع</a>
    <br><br>

    </div>
@endsection
@section('js')
@endsection