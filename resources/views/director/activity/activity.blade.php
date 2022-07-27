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
    @include('director/activity/activity_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('director/activity/activity_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('director/activity/activity_form')

            {{-- DATATABLE --}}
            @include('director/activity/activity_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection


@section('script')
    @include('director/activity/activity_scripts')
@endsection
