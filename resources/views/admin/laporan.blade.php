@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
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
                    {{-- <a href="{{ route('export') }}" class="btn btn-primary">Unduh laporan</a> --}}
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
                            <h3 class="card-title">Laporan</h3>
                            @if ($laporanModule['edit_access']==1 || $laporanModule['full_access']==1)

                            <a style="max-width: 150px; float: right; display:inline-block;" href="{{ route('export')}}"
                                class="btn btn-block btn-primary">Cetak</a>
                            @endif

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body row d-flex justify-content-center mt-5 mb-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped bg-transparent">
                                    <thead>
                                        <tr>
                                            <th scope="col">Checkout ID</th>
                                            <th scope="col">Jumlah Produk</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderSummaries as $sum)
                                        <tr>
                                            <td>{{ $sum['orders'][0]->checkout_id }}</td>
                                            <td>{{ $sum['count'] }}</td>
                                            <td>Rp {{ number_format($sum['total'], 0, ',', '.') }}</td>
                                            <td>{{ $sum['orders'][0]->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


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