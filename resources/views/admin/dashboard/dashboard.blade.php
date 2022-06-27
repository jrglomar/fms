@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.admin_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@section('section_header')
    <h1>{{ $page_title }}</h1>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('admin.dashboard.dashboard_content')
    @endsection


{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection

@section('script')
    @include('admin.dashboard.dashboard_scripts')
@endsection

