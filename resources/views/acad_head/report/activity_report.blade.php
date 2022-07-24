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
    @include('acad_head/report/activity_report_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    

    {{-- CONTENT --}}
    @section('content')
            {{-- FORM --}}
          
            {{-- DATATABLE --}}
            @include('acad_head/report/activity_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection

@section('script')
    @include('acad_head/report/activity_report_scripts')
@endsection
