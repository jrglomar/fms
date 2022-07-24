@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.faculty_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.faculty_sidebar')
@endsection

@section('section_header')
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('faculty/report/activity_report_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    

    {{-- CONTENT --}}
    @section('content')
            {{-- FORM --}}
          
            {{-- DATATABLE --}}
            @include('faculty/report/activity_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection

@section('script')
    @include('faculty/report/activity_report_scripts')
@endsection
