@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.checker_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.checker_sidebar')
@endsection

@section('section_header')
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('checker/profile/profile_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('checker/profile/profile_modal')

    {{-- CONTENT --}}
    @section('content')
        

            {{-- FORM --}}
            @include('checker/profile/profile_form')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.checker_footer')
@endsection


@section('script')
    @include('checker/profile/profile_scripts')
@endsection
