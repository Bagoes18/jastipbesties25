@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Request Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Request Product</li>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
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
                        <div class="card-header">
                            <h3 class="card-title">Request Produk</h3>




                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">

                            <table class="table table-bordered table-striped bg-transparent">
                                <thead>
                                    <tr>
                                        <th scope="col">name</th>
                                        <th scope="col">image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request as $req)
                                    <tr>
                                        <td>{{ $req->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#image{{ $loop->index }}">image</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="image{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Image</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    @if ($req->image)
                                                    <img src="{{ asset('storage/RequestProduct/' . $req->image) }}"
                                                        alt="Bukti Pembayaran" class="img-fluid">
                                                    @else
                                                    <p>Tidak Ada Image</p>
                                                    @endif
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
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