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
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('acad_head/class_attendance_reports/class_attendance_reports_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('acad_head/class_attendance_reports/class_attendance_reports_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('acad_head/class_attendance_reports/class_attendance_reports_form')

            {{-- DATATABLE --}}
            @include('acad_head/class_attendance_reports/class_attendance_reports_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('layouts/class_schedule_response')
    @include('acad_head/class_attendance_reports/class_attendance_reports_scripts')
@endsection
