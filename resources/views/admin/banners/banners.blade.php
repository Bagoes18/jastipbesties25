@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Banner ( Iklan )</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Banner ( Iklan )</li>
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
                <div class="col-12">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong>{{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Banner</h3>

                            @if ($bannersModul['edit_access']==1 ||
                            $bannersModul['full_access']==1)
                            <a style="max-width: 150px; float: right; display:inline-block;"
                                href="{{ url('admin/add-edit-banner') }}" class="btn btn-block btn-primary">Tambah
                                Banner</a>
                            @endif

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="banners" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Tipe</th>
                                        <th>Link</th>
                                        <th>Judul</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $banner['id'] }}</td>
                                        <td><a target="_blank"
                                                href="{{ url('front/images/banners/'.$banner['image']) }}"><img
                                                    style="width: 180px;"
                                                    src="{{ asset('front/images/banners/'.$banner['image']) }}"></a>
                                        </td>
                                        <td>{{ $banner['type'] }}</td>
                                        <td>{{ $banner['link'] }}</td>
                                        <td>{{ $banner['title'] }}</td>

                                        <td>

                                            @if ($bannersModul['edit_access']==1 ||
                                            $bannersModul['full_access']==1)
                                            @if ($banner['status']==1)
                                            <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}"
                                                banner_id="{{ $banner['id'] }}" href="javascript:void(0)"><i
                                                    class="fas fa-toggle-on" status="Active"></i></a>
                                            @else
                                            <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}"
                                                banner_id="{{ $banner['id'] }}" style="color:grey"
                                                href="javascript:void(0)"><i class="fas fa-toggle-off"
                                                    status="Inactive"></i></a>
                                            @endif
                                            @endif




                                            &nbsp; &nbsp;

                                            @if ($bannersModul['edit_access']==1 ||
                                            $bannersModul['full_access']==1)
                                            <a href="{{ url('admin/add-edit-banner',$banner['id']) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            &nbsp; &nbsp;
                                            @endif
                                            @if ($bannersModul['full_access']==1)
                                            <a class="confirmDelete" title="Delete banner" href="javascript:void(0)"
                                                record="banner" recordid="{{ $banner['id'] }}"><i
                                                    class="fas fa-trash"></i></a>
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection