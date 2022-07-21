@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.acad_head_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.acad_head_sidebar')
@endsection

@section('section_header')
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('acad_head/meeting/meeting_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('acad_head/meeting/meeting_modal')

    {{-- CONTENT --}}
    @section('content')
        

            {{-- DETAILS --}}
            @include('acad_head/meeting/meeting_view_content')

            {{-- FORM --}}
            @include('acad_head/meeting/meeting_form')

            {{-- DATATABLE --}}
            @include('acad_head/meeting/meeting_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('layouts/global_custom_scripts')
    @include('acad_head/meeting/meeting_scripts')
@endsection
