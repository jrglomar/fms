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
    @include('director/report/srd_reports_breadcrumbs')
</div>
@endsection
    
    {{-- CONTENT --}}
    @section('content')
          
            {{-- DATATABLE --}}
            @include('director/report/srd_reports_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection

@section('script')
    @include('director/report/srd_reports_scripts')
@endsection
