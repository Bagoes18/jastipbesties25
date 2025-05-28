@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Beranda</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Beranda</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  @if (Session::has('error_message'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error:</strong>{{ Session::get('error_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>

            <a style="color: #fff" href="{{ url('admin/categories') }}">
              <div class="info-box-content">
                <span class="info-box-text">Kategori</span>
                <span class="info-box-number">
                  {{ $categoryCount }}
                  {{-- <small>%</small> --}}
                </span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">

            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tshirt"></i></span>
            <a style="color: #fff" href="{{ url('admin/products') }}">

              <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">{{ $productsCount }}</span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tags"></i></span>
            <a style="color: #fff" href="{{ url('admin/brands') }}">

              <div class="info-box-content">
                <span class="info-box-text">Merek</span>
                <span class="info-box-number">{{ $brandsCount }}</span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            {{-- <a style="color: #fff" href="{{ url('admin/user') }}"> --}}
              <div class="info-box-content">
                <span class="info-box-text">Pengguna</span>
                <span class="info-box-number">{{ $usersCount }}</span>
              </div>
              {{--
            </a> --}}
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>

@endsection