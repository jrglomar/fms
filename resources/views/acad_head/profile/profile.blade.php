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
                Profile
            </li>
            <li class="breadcrumb-item" id="acad_head_profile">
            <a href="/acad_head/profile">Profile</a>
                <script>
                    if(window.location.pathname == '/acad_head/profile')
                    {
                        document.getElementById("acad_head_profile").classList.add('active');
                        document.getElementById("acad_head_profile").setAttribute("aria-current", "page")
                    }
                </script>
            </li>
        </ol>
    </nav>
</div>
@endsection

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
