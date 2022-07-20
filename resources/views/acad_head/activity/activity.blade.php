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

    {{-- MODAL --}}
    @include('acad_head/activity/activity_modal')

    {{-- CONTENT --}}
    @section('content')
        @include('acad_head/activity/activity_breadcrumbs')

            {{-- FORM --}}
            @include('acad_head/activity/activity_form')

            {{-- DATATABLE --}}
            @include('acad_head/activity/activity_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/activity/activity_scripts')
@endsection
