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
    @include('acad_head/requirement_list_type/requirement_list_type_modal')

    {{-- CONTENT --}}
    @section('content')
        <!-- <h2 class="section-title">Description</h2> -->
        <!-- <p class="section-lead" id="description_paragraph"></p> -->

            {{-- DETAILS --}}
            @include('acad_head/requirement_list_type/requirement_list_type_content')

            {{-- FORM --}}
            @include('acad_head/requirement_list_type/requirement_list_type_form')

            {{-- DATATABLE --}}
            @include('acad_head/requirement_list_type/requirement_list_type_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/requirement_list_type/requirement_list_type_scripts')
@endsection
