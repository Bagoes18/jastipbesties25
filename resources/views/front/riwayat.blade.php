@extends('front.layout.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS (Popper included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Riwayat</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Beranda</a>
                        <span> / Riwayat</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex w-100 justify-content-center mt-5 mb-5">

            <form action="{{ route('checkout.order') }}" method="POST">
                @csrf

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Checkout ID</th>
                            <th scope="col">Jumlah Produk</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderSummaries as $sum)
                        <tr>
                            <td>{{ $sum['orders'][0]->checkout_id }}</td>
                            <td>{{ $sum['count'] }}</td>
                            <td>Rp {{ number_format($sum['total'], 0, ',', '.') }}</td>
                            <td>{{ $sum['orders'][0]->status }}</td>
                            <td>
                                @if ($sum['orders'][0]->status === 'Diterima')
                                <a href="{{ route('orders.invoice', ['checkout_id' => $sum['orders'][0]['checkout_id'], 'user_id' => $sum['orders'][0]['user_id']]) }}"
                                    class="btn btn-success btn-sm" target="_blank">
                                    Cetak
                                </a>

                                @elseif ($sum['orders'][0]->payment_proof)
                                <a href="/payment/{{ $sum['orders'][0]->checkout_id }}"
                                    class="btn btn-primary btn-sm">Detail</a>
                                @else
                                <a href="/payment/{{ $sum['orders'][0]->checkout_id }}"
                                    class="btn btn-warning btn-sm">Bayar</a>
                                @endif
                            </td>

                            {{-- <td>
                                @if ($sum['orders'][0]->payment_proof)
                                <a href="/payment/{{ $sum['orders'][0]->checkout_id }}"
                                    class="btn btn-primary">Detail</a>
                                @else
                                <a href="/payment/{{ $sum['orders'][0]->checkout_id }}"
                                    class="btn btn-primary">Bayar</a>
                                @endif
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>

    </div>
</div>
@endsection