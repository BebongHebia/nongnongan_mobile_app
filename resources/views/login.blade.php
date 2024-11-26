<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OBMSDT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page" style="background-color: #3A6C7C;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="background-color: #3A6C7C; border-color: #ffffff;">
    <div class="card-header text-center">
        <center>
            <img src="{{ asset('images/logo.png') }}" class="img-fluid img-circle">
        </center>
      <a href="{{ url('/') }}" class="h5" style="color: white;"><b>Barangay Old Nongnongnan Daily Transaction System</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg" style="color: white;"> Sign in to start your session </p>

      <form action="{{ url('/login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enter Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Enter Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"> Sign In </button>
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
        <div class="col-sm-12">
        </div>
      </div>

      </form>
      <div class="row mt-2">
        <div class="col-sm-12">
            <center>
                <a href="{{ url('/create-account') }}" class="btn btn-success btn-block">
                    Create Account
                </a>
            </center>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 pt-2">
            <center>
                <a href="{{ url('/forgot-password') }}" class="text-start mt-2" style="color: white;"> Forgot Password? </a>

            </center>
        </div>
      </div>


    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
