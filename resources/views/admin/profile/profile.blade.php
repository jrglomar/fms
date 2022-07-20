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

    {{-- CONTENT --}}
    @section('content')
        @include('admin/profile/profile_breadcrumbs')

            {{-- FORM --}}
            @include('admin/profile/profile_form')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection


@section('script')
    @include('admin/profile/profile_scripts')
@endsection
