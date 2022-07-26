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
    @include('admin/specialization/specialization_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('admin/specialization/specialization_modal')

    {{-- CONTENT --}}
    @section('content')
        

            {{-- FORM --}}
            @include('admin/specialization/specialization_form')

            {{-- DATATABLE --}}
            @include('admin/specialization/specialization_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('layouts/global_custom_scripts')
    @include('admin/specialization/specialization_scripts')
@endsection
