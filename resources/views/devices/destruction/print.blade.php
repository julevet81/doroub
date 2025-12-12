@extends('dashboard.layouts.master')

@section('content')

    <style>
        .pdf-container {
            position: relative;
            width: 800px;
            margin: auto;
        }

        .overlay {
            position: absolute;
            font-size: 16px;
            font-weight: bold;
        }

        /* أمثلة تحديد مواقع النص فوق PDF */
        #deviceName {
            top: 120px;
            left: 200px;
        }

        #barcode {
            top: 160px;
            left: 200px;
        }

        #count {
            top: 200px;
            left: 200px;
        }

        #reason {
            top: 240px;
            left: 200px;
        }

        #date {
            top: 280px;
            left: 200px;
        }
    </style>

    <div class="pdf-container">

        <embed src="{{ asset('assets/certificates/101.pdf') }}" type="application/pdf" width="100%" height="900px">

        <div id="deviceName" class="overlay">{{ $device->name }}</div>
        <div id="barcode" class="overlay">{{ $device->barcode }}</div>
        <div id="count" class="overlay">{{ $device->usage_count }}</div>
        <div id="reason" class="overlay">{{ $device->destruction_reason }}</div>
        <div id="date" class="overlay">{{ $device->destruction_date }}</div>

    </div>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-danger">طباعة التقرير</button>
    </div>

@endsection