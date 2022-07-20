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
        @include('faculty/profile/profile_breadcrumbs')

            {{-- FORM --}}
            @include('faculty/profile/profile_form')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection


@section('script')
    @include('faculty/profile/profile_scripts')
@endsection
