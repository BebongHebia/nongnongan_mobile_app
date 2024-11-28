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

                <form action="{{ url('/search-account-for-recovery') }}" method="post">
                    @csrf

                    <label style="color:white">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                    <label style="color:white">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">

                    <button class="btn btn-success btn-block mt-2">
                        <i class="fas fa-search"></i> Search Account
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
