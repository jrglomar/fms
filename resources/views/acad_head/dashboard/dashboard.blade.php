@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.acad_head_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.acad_head_sidebar')
@endsection

@section('section_header')
    <h1>{{ $page_title }}</h1>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('acad_head.dashboard.dashboard_content')
    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection

@section('script')
    @include('acad_head.dashboard.dashboard_scripts')
@endsection

