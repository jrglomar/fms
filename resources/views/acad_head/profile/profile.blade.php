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
    @include('acad_head/profile/profile_breadcrumbs')
</div>
@endsection

    {{-- MODAL --}}
    @include('acad_head/profile/profile_modal')

    {{-- CONTENT --}}
    @section('content')
        

            {{-- FORM --}}
            @include('acad_head/profile/profile_form')

    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/profile/profile_scripts')
@endsection
