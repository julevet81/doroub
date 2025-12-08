@extends('dashboard.layouts.master')
@section('title')
    بيانات الدور
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">بيانات الدور</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="container">
    <div>
        <h2>بيانات الدور</h2>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المفتاح</th>
                <th>القيمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roleData as $key => $value)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
@endsection
@section('js')
@endsection