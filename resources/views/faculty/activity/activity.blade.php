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
    @include('faculty/activity/activity_breadcrumbs')
</div>
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
