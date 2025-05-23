<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jatip Admin Panel | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="admin/index2.html" class="h1"><b>Login</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Masuk untuk memulai sesi</p>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if (Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error:</strong>{{ Session::get('error_message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if (Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success:</strong>{{ Session::get('success_message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form action="{{ route('login') }}" method="post">@csrf
          <div class="input-group mb-3">
            <input name="email" type="text" class="form-control" placeholder="Masukkan Email" required=""
              @if(isset($_COOKIE['email'])) value="{{ $_COOKIE['email'] }}" @endif>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Masukkan Sandi" required=""
              @if(isset($_COOKIE ['password'])) value="{{ $_COOKIE['password'] }}" @endif>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <a href="/register">Register</a>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" @if (isset($_COOKIE ["email"])) checked="" @endif>
                <label for="remember">
                  Ingat Sesi
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('admin/js/adminlte.min.js') }}"></script>
  <script>
    // Menonaktifkan tombol "Back"
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.forward();
        };
    }
  </script>

</body>

</html>