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
    @include('admin/meeting_type/meeting_type_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('admin/meeting_type/meeting_type_modal')

    {{-- CONTENT --}}
    @section('content')

            {{-- FORM --}}
            @include('admin/meeting_type/meeting_type_form')

            {{-- DATATABLE --}}
            @include('admin/meeting_type/meeting_type_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('admin/meeting_type/meeting_type_scripts')
@endsection
