@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengaturan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Perbarui Sandi Admin</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Perbarui Sandi Admin</h3>
            </div>
            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error: </strong>{{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            @endif
            @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success: </strong>{{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ url('admin/update-password') }}">@csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="admin_email">Email</label>
                  <input class="form-control" id="admin_email" value="{{ Auth::guard('admin')->user()->email }}"
                    readonly="" style="background-color: #666">
                </div>
                <div class="form-group">
                  <label for="current_pwd">Sandi saat ini</label>
                  <input type="password" class="form-control" name="current_pwd" id="current_pwd"
                    placeholder="Sandi saat ini">
                  <span id="verifyCurrentPwd"></span>
                </div>
                <div class="form-group">
                  <label for="new_pwd">Sandi Baru</label>
                  <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="Sandi Baru">
                </div>
                <div class="form-group">
                  <label for="confirm_pwd">Konfirmasi Sandi Baru</label>
                  <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd"
                    placeholder="Konfirmasi Sandi">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection