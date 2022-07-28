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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item" id="checker_dashboard">
            <a href="/checker/dashboard">Dashboard</a>
                <script>
                    if(window.location.pathname == '/checker/dashboard')
                    {
                        document.getElementById("checker_dashboard").classList.add('active');
                        document.getElementById("checker_dashboard").setAttribute("aria-current", "page")
                    }
                </script>
            </li>
        </ol>
    </nav>
</div>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('checker.dashboard.dashboard_content')
    @endsection

{{-- FOOTER --}}
@section('footer')
    @include('layouts.checker_footer')
@endsection

@section('script')
    @include('layouts/class_schedule_response')
    @include('checker.dashboard.dashboard_scripts')
@endsection

