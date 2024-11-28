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

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-header text-center">
                <center>
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid img-circle">
                </center>
                <a href="{{ url('/') }}" class="h5" style="color: white;"><b>Barangay Old Nongnongnan Daily Transaction System</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg" style="color: white;"> Recover Password </p>

                <h5 class="text-start" style="color:white">{{ $user_details->complete_name }}</h5>

                <form action="{{ url('/change-password') }}" method="post">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ $user_details->id }}">

                    <label style="color:white">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                    <label style="color:white">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password">

                    <button class="btn btn-success btn-block mt-2">
                        <i class="fas fa-save"></i> Save Password
                    </button>
                </form>

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
