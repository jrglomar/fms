@extends('layouts.app')

{{-- NAVBAR --}}
@section('navbar')
    @include('layouts.director_navbar')
@endsection

{{-- SIDEBAR --}}
@section('sidebar')
    @include('layouts.director_sidebar')
@endsection

@section('section_header')
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    @include('director/profile/profile_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('director/profile/profile_modal')

    {{-- CONTENT --}}
    @section('content')
        

            {{-- FORM --}}
            @include('director/profile/profile_form')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection


@section('script')
    @include('director/profile/profile_scripts')
@endsection
