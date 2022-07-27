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
    @include('director/observation/observation_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('director/observation/observation_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('director/observation/observation_form')

            {{-- DATATABLE --}}
            @include('director/observation/observation_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection


@section('script')
    @include('director/observation/class_schedule_response')
    @include('director/observation/observation_scripts')
@endsection
