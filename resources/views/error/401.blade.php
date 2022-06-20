@extends('layouts.login')

@section('content')

    <div class="container mt-2">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="https://cdn.pup.edu.ph/img/symbols/logo88x88.png" alt="logo" width="100"
                class="shadow-light rounded-circle">
                <h4>PUPQCSS</h4>
            </div>
            <div class="card card-primary" id="login_card">
                <div class="card-header">
                <h4 class="text-dark">{{ $page_title }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    <button type="button" onclick="location.href='/login'" class="shadow-none btn btn-primary btn-lg btn-block" tabindex="4">
                        Go to Login <i class="fas fa-sign-in-alt"></i>
                    </button>
                </div>
            </div>

            </div>
        </div>
    </div>

@endsection
