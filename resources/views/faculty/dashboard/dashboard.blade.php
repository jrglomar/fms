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
<div class='container-fluid'>
    <h1>{{ $page_title }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item" id="faculty_dashboard">
            <a href="/faculty/dashboard">Dashboard</a>
                <script>
                    if(window.location.pathname == '/faculty/dashboard')
                    {
                        document.getElementById("faculty_dashboard").classList.add('active');
                        document.getElementById("faculty_dashboard").setAttribute("aria-current", "page")
                    }
                </script>
            </li>
        </ol>
    </nav>
</div>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('faculty.dashboard.dashboard_content')
    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.faculty_footer')
@endsection

@section('script')
    @include('faculty.dashboard.dashboard_scripts')
@endsection

