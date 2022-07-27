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
    @include('faculty/observation/observation_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('faculty/observation/observation_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('faculty/observation/observation_form')

            {{-- DATATABLE --}}
            @include('faculty/observation/observation_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection


@section('script')
    @include('layouts/class_schedule_response')
    @include('faculty/observation/observation_scripts')
@endsection
