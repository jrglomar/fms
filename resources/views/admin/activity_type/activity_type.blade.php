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
    @include('admin/activity_type/activity_type_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('admin/activity_type/activity_type_modal')

    {{-- CONTENT --}}
    @section('content')
        
            {{-- FORM --}}
            @include('admin/activity_type/activity_type_form')

            {{-- DATATABLE --}}
            @include('admin/activity_type/activity_type_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('admin/activity_type/activity_type_scripts')
@endsection
