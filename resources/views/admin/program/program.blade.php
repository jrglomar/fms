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
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('admin/program/program_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('admin/program/program_modal')

    {{-- CONTENT --}}
    @section('content')
        

            {{-- FORM --}}
            @include('admin/program/program_form')

            {{-- DATATABLE --}}
            @include('admin/program/program_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('layouts/global_custom_scripts')
    @include('admin/program/program_scripts')
@endsection
