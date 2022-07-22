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
    @include('admin/profile/profile_breadcrumbs')
</div>
@endsection

    {{-- CONTENT --}}
    @section('content')
        

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
