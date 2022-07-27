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
    @include('director/requirement_type/requirement_type_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('director/requirement_type/requirement_type_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('director/requirement_type/requirement_type_form')

            {{-- DATATABLE --}}
            @include('director/requirement_type/requirement_type_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection


@section('script')
    @include('director/requirement_type/requirement_type_scripts')
@endsection
