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
    @include('director/activity_view/activity_view_breadcrumbs')
</div>
@endsection

{{-- MODAL --}}
@include('director/activity_view/activity_view_modal')

    {{-- CONTENT --}}
    @section('content')
        
            {{-- MAIN CONTENT --}}
            @include('director/activity_view/activity_view_content')
            &nbsp;
            @include('director/activity_view/required_faculty_list_view_datatable')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection


@section('script')
    @include('director/activity_view/activity_view_scripts')
@endsection
