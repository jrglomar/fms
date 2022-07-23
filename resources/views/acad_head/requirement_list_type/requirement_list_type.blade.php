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
<div class='container-fluid'>
    <div class="col-12 d-flex justify-content-between">
        <h1>{{ $page_title }}</h1>
        <button id="btnTour" class="btn btn-primary btn-sm float-right">Start Page Tour</button>
    </div>
    @include('acad_head/requirement_list_type/requirement_list_type_breadcrumbs')
</div>
            
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
            @include('acad_head/requirement_list_type/required_faculty_list_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/requirement_list_type/requirement_list_type_scripts')
    @include('acad_head/requirement_list_type/required_faculty_list_scripts')
    @include('acad_head/requirement_list_type/requirement_list_type_tour_scripts')
@endsection
