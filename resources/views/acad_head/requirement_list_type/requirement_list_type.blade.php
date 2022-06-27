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
    <h1 id="page_title"></h1>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <p id="deadline"></p>
@endsection

    {{-- MODAL --}}
    @include('acad_head/requirement_list_type/requirement_list_type_modal')

    {{-- CONTENT --}}
    @section('content')
        <!-- <h2 class="section-title">Description</h2> -->
        <!-- <p class="section-lead" id="description_paragraph"></p> -->
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Description:</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse">
                        <div class="card-body">
                            <p class="section-lead" id="description_paragraph"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            {{-- FORM --}}
            @include('acad_head/requirement_list_type/requirement_list_type_form')

            {{-- DATATABLE --}}
            @include('acad_head/requirement_list_type/requirement_list_type_datatable')
    @endsection



{{-- FOOTER --}}
@section('footer')
    @include('layouts.acad_head_footer')
@endsection


@section('script')
    @include('acad_head/requirement_list_type/requirement_list_type_scripts')
@endsection
