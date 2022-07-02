@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.admin_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@section('section_header')
    <h1>{{ $page_title }}</h1>
@endsection

    {{-- MODAL --}}
    @include('admin/faculty_type/faculty_type_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('admin/faculty_type/faculty_type_form')

            {{-- DATATABLE --}}
            @include('admin/faculty_type/faculty_type_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('layouts/global_custom_scripts')
    @include('admin/faculty_type/faculty_type_scripts')
@endsection
