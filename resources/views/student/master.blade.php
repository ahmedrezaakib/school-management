@extends('student.layout')

@section('customCss')
<link rel="stylesheet" href="{{ asset('assets/css/school-theme.css') }}">
@endsection

@section('customJs')
<script src="{{ asset('assets/js/school-theme.js') }}"></script>
@endsection

{{-- Every page will fill this --}}
@section('content')
    @yield('page')
@endsection
