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
    @include('checker/class_attendance_reports/class_attendance_reports_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('checker/class_attendance_reports/class_attendance_reports_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('checker/class_attendance_reports/class_attendance_reports_form')

            {{-- DATATABLE --}}
            @include('checker/class_attendance_reports/class_attendance_reports_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.checker_footer')
@endsection


@section('script')
    @include('layouts/class_schedule_response')
    @include('checker/class_attendance_reports/class_attendance_reports_scripts')
@endsection
