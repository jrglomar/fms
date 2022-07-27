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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item" id="director_dashboard">
            <a href="/director/dashboard">Dashboard</a>
                <script>
                    if(window.location.pathname == '/director/dashboard')
                    {
                        document.getElementById("director_dashboard").classList.add('active');
                        document.getElementById("director_dashboard").setAttribute("aria-current", "page")
                    }
                </script>
            </li>
        </ol>
    </nav>
</div>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('director.dashboard.dashboard_content')
    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.director_footer')
@endsection

@section('script')
    @include('director.dashboard.dashboard_scripts')
@endsection

