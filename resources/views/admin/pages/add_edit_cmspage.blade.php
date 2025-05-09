@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $title }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">{{ $title }}</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <form name="cmsForm" id="cmsForm" @if (empty($cmspage['id']))
                action="{{ url('admin/add-edit-cms-page') }}" @else
                action="{{ url('admin/add-edit-cms-page/'.$cmspage['id']) }}" @endif method="post">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Judul*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan Judul Halaman"
                      @if (!empty($cmspage['title'])) value="{{ $cmspage['title'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="url">URL*</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan URL Halaman"
                      @if(!empty($cmspage['url'])) value="{{ $cmspage['url'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="description">Deskripsi*</label>
                    <textarea class="form-control" rows="3" id="description" name="description"
                      placeholder="Masukkan Deskripsi">@if (!empty($cmspage['description'])){{ $cmspage['description'] }}@endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_title">Tag Judul</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                      placeholder="Masukkan Tag Judul" @if (!empty($cmspage['meta_title']))
                      value="{{ $cmspage['meta_title'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Tag Deskripsi</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description"
                      placeholder="Masukkan Tag Deskripsi" @if (!empty($cmspage['meta_description']))
                      value="{{ $cmspage['meta_description'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_keywords">Tag Kata Kunci</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                      placeholder="Masukkan Tag Kata Kunci" @if (!empty($cmspage['meta_keywords']))
                      value="{{ $cmspage['meta_keywords'] }}" @endif>
                  </div>
                </div>
                <div class="form-group">
                  <button type=" submit" class="btn btn-primary">Kirim</button>
                </div>
                <!-- /.card-body -->

              </form>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection