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
    @include('admin/role/role_modal')

    {{-- CONTENT --}}
    @section('content')
        @include('admin/role/role_breadcrumbs')

            {{-- FORM --}}
            @include('admin/role/role_form')

            {{-- DATATABLE --}}
            @include('admin/role/role_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('layouts/global_custom_scripts')
    @include('admin/role/role_scripts')
@endsection
