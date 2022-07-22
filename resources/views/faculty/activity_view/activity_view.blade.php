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
    @include('faculty/activity_view/activity_view_breadcrumbs')
</div>
@endsection

{{-- MODAL --}}
@include('faculty/activity_view/activity_view_modal')

    {{-- CONTENT --}}
    @section('content')
            {{-- MAIN CONTENT --}}
            @include('faculty/activity_view/activity_view_content')
            &nbsp;
            @include('faculty/activity_view/required_faculty_list_view_datatable')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection


@section('script')
    @include('faculty/activity_view/activity_view_scripts')
@endsection
