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
                            @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong>{{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
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
                            <form name="bannerForm" id="bannerForm" @if (empty($banner['id']))
                                action="{{ url('admin/add-edit-banner') }}" @else
                                action="{{ url('admin/add-edit-banner/' . $banner['id']) }}" @endif method="post"
                                enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6">
                                        <label for="type">Tipe Banner</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Pilihan</option>
                                            <option @if (!empty($banner['type'])&&$banner['type']=="Slider" )
                                                selected="" @endif value="Slider">Slider</option>
                                            <option @if (!empty($banner['type'])&&$banner['type']=="Fix 1" ) selected=""
                                                @endif value="Fix 1">Fix 1</option>
                                            <option @if (!empty($banner['type'])&&$banner['type']=="Fix 2" ) selected=""
                                                @endif value="Fix 2">Fix 2</option>
                                            <option @if (!empty($banner['type'])&&$banner['type']=="Fix 3" ) selected=""
                                                @endif value="Fix 3">Fix 3</option>
                                            <option @if (!empty($banner['type'])&&$banner['type']=="Fix 4" ) selected=""
                                                @endif value="Fix 4">Fix 4</option>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="banner_image">Gambar Banner (Iklan)</label>
                                        <input type="file" class="form-control" id="banner_image" name="banner_image">
                                        @if (!empty($banner['image']))
                                        <a target="_blank"
                                            href="{{ url('front/images/banners/'.$banner['image']) }}"><img
                                                style="width: 50px; margin: 10px;"
                                                src="{{ asset('front/images/banners/'.$banner['image']) }}"></a>
                                        <a class="confirmDelete" title="Delete Banner Image" href="javascript:void(0)"
                                            record="banner-image" recordid="{{ $banner['id'] }}" <?php /*
                                            href="{{ url('delete-banner/',$banner['id']) }}" */ ?> ><i
                                                class="fas fa-trash"></i></a>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="title">Judul Banner</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Masukkan Judul Banner" @if(!empty($banner['title']))
                                            value="{{ $banner['title'] }}"> @else value="{{
                                        old('title') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="alt">Alternatif Banner</label>
                                        <input type="text" class="form-control" id="alt" name="alt"
                                            placeholder="Masukkan Alt Banner" @if(!empty($banner['alt']))
                                            value="{{ $banner['alt'] }}"> @else value="{{
                                        old('alt') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="link">Link Banner</label>
                                        <input type="text" class="form-control" id="link" name="link"
                                            placeholder="Masukkan Link Banner" @if(!empty($banner['link']))
                                            value="{{ $banner['link'] }}"> @else value="{{
                                        old('link') }}"> @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sort">Sortir Banner</label>
                                        <input type="number" class="form-control" id="sort" name="sort"
                                            placeholder="Masukkan Link Banner" @if(!empty($banner['sort']))
                                            value="{{ $banner['sort'] }}"> @else value="{{
                                        old('sort') }}"> @endif
                                    </div>



                                </div>
                                <!-- /.card-body -->
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>

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