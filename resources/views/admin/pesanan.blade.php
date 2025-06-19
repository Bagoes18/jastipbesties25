@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
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
                            <h3 class="card-title">Pesanan</h3>

                            {{-- <a style="max-width: 150px; float: right; display:inline-block;"
                                href="{{ route('export')}}" class="btn btn-block btn-primary">Cetak</a> --}}


                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body row d-flex justify-content-center mt-5 mb-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped bg-transparent">
                                    <thead>
                                        <tr>
                                            <th scope="col">Checkout ID</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Jumlah Produk</th>
                                            <th scope="col">List Produk</th>
                                            <th scope="col">Total</th>
                                            {{-- <th scope="col">Status</th> --}}
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderSummaries as $sum)
                                        <tr>
                                            <td>{{ $sum['orders'][0]->checkout_id }}</td>
                                            <td>{{ $sum['orders'][0]->user->name }}</td>
                                            <td>{{ $sum['count'] }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($sum['orders'] as $order)
                                                    <li>{{ $order->product->product_name }}</li>
                                                    @endforeach
                                                </ul>

                                            </td>
                                            <td>Rp {{ number_format($sum['total'], 0, ',', '.') }}</td>
                                            {{-- <td>{{ $sum['orders'][0]->status }}</td> --}}
                                            <td>
                                                @if ($pesananModul['edit_access']==1 || $pesananModul['full_access']==1)
                                                @if($sum['orders'][0]->status == 'Diterima' || $sum['orders'][0]->status
                                                ==
                                                'Ditolak')
                                                {{ $sum['orders'][0]->status }}
                                                @else
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#bukti{{ $loop->index }}">Bukti</button>
                                                <a href="{{ route('payment.accept', $sum['orders'][0]->checkout_id) }}"
                                                    class="btn btn-success">Terima</a>

                                                <a href="{{ route('payment.reject', $sum['orders'][0]->checkout_id) }}"
                                                    class="btn btn-danger">Tolak</a>

                                                @endif
                                                @else
                                                -
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="bukti{{ $loop->index }}" tabindex="-1"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Bukti Pembayaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @if ($sum['orders'][0]->payment_proof)
                                                        <img src="{{ asset('storage/PaymentProof/' . $sum['orders'][0]->payment_proof) }}"
                                                            alt="Bukti Pembayaran" class="img-fluid">
                                                        @else
                                                        <p>Bukti pembayaran tidak tersedia</p>
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