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
    @include('checker/schedule/schedule_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('checker/schedule/schedule_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('checker/schedule/schedule_form')

            {{-- DATATABLE --}}
            @include('checker/schedule/schedule_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.checker_footer')
@endsection


@section('script')
    @include('layouts/class_schedule_response')
    @include('checker/schedule/schedule_scripts')
@endsection
