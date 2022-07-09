
    <div class="container mt-2">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="https://cdn.pup.edu.ph/img/symbols/logo88x88.png" alt="logo" width="100"
                class="shadow-light rounded-circle">
                <h4>PUPQCFMS</h4>
            </div>
            <div class="card card-primary" id="login_card">
                <div class="card-header">
                <h4 class="text-dark">Login</h4>
                </div>
                <div class="card-body">
                {{-- <p>Login using your email and password.</p> --}}
                <form id="loginForm" data-parsley-validate>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                        tabindex="1" required data-parsley-required-message="Please fill in your email."
                        autofocus>
                    </div>
                    <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                        <a href="" class="text-small text-info">
                            Forgot Password?
                        </a>
                        </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                        tabindex="2" required data-parsley-required-message="Please fill in your password."
                        >
                    </div>

                    <div class="form-group">
                    <button type="submit" class="shadow-none btn btn-primary btn-lg btn-block" tabindex="4">
                        Login <i class="fas fa-sign-in-alt"></i>
                    </button>
                    </div>
                </form>
                </div>
            </div>

            </div>
        </div>
    </div>
