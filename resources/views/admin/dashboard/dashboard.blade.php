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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #FFFFFF; padding-left: 0px; margin-bottom: 0px">
            <li class="breadcrumb-item">
                Dashboard
            </li>
            <li class="breadcrumb-item" id="admin_dashboard">
            <a href="/admin/dashboard">Dashboard</a>
                <script>
                    if(window.location.pathname == '/admin/dashboard')
                    {
                        document.getElementById("admin_dashboard").classList.add('active');
                        document.getElementById("admin_dashboard").setAttribute("aria-current", "page")
                    }
                </script>
            </li>
        </ol>
    </nav>
</div>
@endsection

    {{-- CONTENT --}}
    @section('content')
        @include('admin.dashboard.dashboard_content')
    @endsection


{{-- FOOTER --}}
@section('footer')
    @include('layouts.admin_footer')
@endsection

@section('script')
    @include('admin.dashboard.dashboard_scripts')
@endsection

