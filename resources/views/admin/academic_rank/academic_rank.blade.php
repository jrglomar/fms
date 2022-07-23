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
    @include('admin/academic_rank/academic_rank_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('admin/academic_rank/academic_rank_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('admin/academic_rank/academic_rank_form')

            {{-- DATATABLE --}}
            @include('admin/academic_rank/academic_rank_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('layouts/global_custom_scripts')
    @include('admin/academic_rank/academic_rank_scripts')
@endsection
