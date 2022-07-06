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
    <h1>{{ $page_title }}</h1>
@endsection

    {{-- MODAL --}}
    @include('faculty/activity/activity_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('faculty/activity/activity_form')

            {{-- DATATABLE --}}
            @include('faculty/activity/activity_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection


@section('script')
    @include('faculty/activity/activity_scripts')
@endsection
