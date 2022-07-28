@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.checker_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.checker_sidebar')
@endsection

@section('section_header')
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('checker/schedule_view/schedule_view_breadcrumbs')
</div>
@endsection

{{-- MODAL --}}
@include('checker/schedule_view/schedule_view_modal')
@include('checker/schedule_view/class_attendance_modal')

    {{-- CONTENT --}}
    @section('content')
        
            {{-- MAIN CONTENT --}}
            @include('checker/schedule_view/schedule_view_content')

    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.checker_footer')
@endsection


@section('script')
    @include('layouts/class_schedule_response')
    @include('checker/schedule_view/class_attendance_scripts')
    @include('checker/schedule_view/class_attendance_file_upload_scripts')
    @include('checker/schedule_view/schedule_view_scripts')
@endsection
