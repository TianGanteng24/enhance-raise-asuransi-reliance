@extends('layouts.simple')

@section('content')
<div class="hero-static d-flex align-items-center">
  <div class="content">
    <div class="row justify-content-center push">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <!-- Sign In Block -->
        <div class="block block-rounded mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Sign In</h3>
            <div class="block-options">
              <a class="btn-block-option fs-sm" href="op_auth_reminder.html">Forgot Password?</a>
              <a class="btn-block-option" href="op_auth_signup.html" data-bs-toggle="tooltip" data-bs-placement="left" title="New Account">
                <i class="fa fa-user-plus"></i>
              </a>
            </div>
          </div>
          <div class="block-content">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
              <h1 class="h3 mb-1">Claim Investigation System</h1>
              <h1 class="h2 mb-1">PT DIM</h1>
              <p class="fw-medium text-muted">
                Welcome, please login.
              </p>

              <!-- Sign In Form -->
              <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
              <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
              <form  action="{{ route('login')}}" method="POST">
                @csrf
                <div class="py-3">
                  <div class="mb-4">
                    <input id="email" type="email" class="form-control form-control-alt form-control-lg" placeholder="Username"  required autocomplete="email">
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-alt form-control-lg" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="login-remember" name="login-remember">
                      <label class="form-check-label" for="login-remember">Remember Me</label>
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-md-6 col-xl-5">
                    <button type="submit" class="btn w-100 btn-alt-primary">
                      <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> {{ __('Login') }}
                    </button>
                  </div>
                </div>
              </form>
              <!-- END Sign In Form -->
            </div>
          </div>
        </div>
        <!-- END Sign In Block -->
      </div>
    </div>
    <div class="fs-sm text-muted text-center">
      <strong>OneUI 5.0</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
  </div>
</div>

        <!-- <script src="assets/js/oneui.app.min.js"></script> -->

<!-- jQuery (required for jQuery Validation plugin) -->
<!-- <script src="assets/js/lib/jquery.min.js"></script> -->

<!-- Page JS Plugins -->
<!-- <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script> -->

<!-- Page JS Code -->
<!-- <script src="assets/js/pages/op_auth_signin.min.js"></script> -->

@endsection
