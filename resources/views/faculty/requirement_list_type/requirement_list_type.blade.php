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
    @include('faculty/requirement_list_type/requirement_list_type_modal')

    {{-- CONTENT --}}
    @section('content')
        @include('faculty/requirement_list_type/requirement_list_type_breadcrumbs')
        <!-- <h2 class="section-title">Description</h2> -->
        <!-- <p class="section-lead" id="description_paragraph"></p> -->

            {{-- DETAILS --}}
            @include('faculty/requirement_list_type/requirement_list_type_content')

            {{-- FORM --}}
            @include('faculty/requirement_list_type/requirement_list_type_form')

            {{-- DATATABLE --}}
            @include('faculty/requirement_list_type/required_faculty_list_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection


@section('script')
    @include('faculty/requirement_list_type/requirement_list_type_scripts')
    @include('faculty/requirement_list_type/required_faculty_list_scripts')
@endsection
