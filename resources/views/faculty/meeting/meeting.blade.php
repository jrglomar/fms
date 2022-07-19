@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.faculty_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.faculty_sidebar')
@endsection

@section('section_header')
    <h1>{{ $page_title }}</h1>
@endsection

    {{-- CONTENT --}}
    @section('content')

            {{-- DETAILS --}}
            @include('faculty/meeting/meeting_view_content')

            {{-- DATATABLE --}}
            @include('faculty/meeting/meeting_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection


@section('script')
    @include('faculty/meeting/meeting_scripts')
@endsection
