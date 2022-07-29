@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.director_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.director_sidebar')
@endsection

@section('section_header')
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('director/class_attendance_reports/class_attendance_reports_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('director/class_attendance_reports/class_attendance_reports_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('director/class_attendance_reports/class_attendance_reports_form')

            {{-- DATATABLE --}}
            @include('director/class_attendance_reports/class_attendance_reports_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection


@section('script')
    @include('layouts/class_schedule_response')
    @include('director/class_attendance_reports/class_attendance_reports_scripts')
@endsection
