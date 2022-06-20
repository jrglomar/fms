@extends('layouts.login')

@section('content')

            {{-- FORM --}}
            @include('auth/login_form')

@endsection

@section('script')
    @include('auth/login_scripts')
@endsection
