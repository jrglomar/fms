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
    <h1>{{ $page_title }}</h1>
    @include('acad_head/activity_view/activity_view_breadcrumbs')
</div>
@endsection

{{-- MODAL --}}
@include('acad_head/activity_view/activity_view_modal')

    {{-- CONTENT --}}
    @section('content')
        
            {{-- MAIN CONTENT --}}
            @include('acad_head/activity_view/activity_view_content')
            &nbsp;
            @include('acad_head/activity_view/required_faculty_list_view_datatable')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/activity_view/activity_view_scripts')
@endsection
