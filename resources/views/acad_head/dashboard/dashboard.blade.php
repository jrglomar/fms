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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item" id="acad_head_dashboard">
            <a href="/acad_head/dashboard">Dashboard</a>
                <script>
                    if(window.location.pathname == '/acad_head/dashboard')
                    {
                        document.getElementById("acad_head_dashboard").classList.add('active');
                        document.getElementById("acad_head_dashboard").setAttribute("aria-current", "page")
                    }
                </script>
            </li>
        </ol>
    </nav>
</div>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('acad_head.dashboard.dashboard_content')
    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection

@section('script')
    @include('acad_head.dashboard.dashboard_scripts')
@endsection

