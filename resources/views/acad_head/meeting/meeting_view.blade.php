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

    {{-- MODAL DATATABLE --}}
    @include('acad_head/meeting/meeting_view_modal')

    {{-- CONTENT --}}
    @section('content')
        @include('acad_head/meeting/meeting_view_breadcrumbs')

            {{-- DETAILS --}}
            @include('acad_head/meeting/meeting_view_content')
            
            {{-- DATATABLE --}}
            @include('acad_head/meeting/meeting_view_faculty_attendance_datatable')

    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/meeting/meeting_view_scripts')
@endsection
