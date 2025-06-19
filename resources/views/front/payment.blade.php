@extends('front.layout.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Payment</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Beranda</a>
                        <span> / Payment</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex w-100 justify-content-center mt-5 mb-5">
            <div class="card p-4 shadow-sm">
                <!-- Total Harga -->
                <div class="mb-3">
                    <strong>Total Harga:</strong>
                    <div class="form-control bg-light">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <strong>Metode Pembayaran:</strong>
                    <div class="form-control bg-light">
                        {{ $order->payment->name }}
                    </div>
                </div>

                <!-- Nomor Rekening -->
                <div class="mb-3">
                    <strong>Nomor Rekening Tujuan:</strong>
                    <div class="form-control bg-light">
                        {{ $order->payment->nomor }} a/n {{ $order->payment->atas_nama }}
                    </div>
                </div>

                <!-- Catatan -->
                <div class="mb-3">
                    <strong>Catatan:</strong>
                    <div class="form-control bg-light">
                        @if ($order->status == 'Diterima')
                        Pembayaran telah diterima, terimakasih telah menggunakan layanan kami.
                        @elseif ($order->status == 'Ditolak')
                        Pembayaran ditolak oleh admin, silahkan lakukan pemesanan kembali.
                        @elseif ($order->payment_proof)
                        Bukti pembayaran sudah dikirim, silahkan menunggu konfirmasi.
                        @else
                        Silakan lakukan pembayaran dan unggah bukti transfer Anda.
                        @endif
                    </div>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @if ($order->status != 'Diterima' && $order->status != 'Ditolak')
                    <button class="btn btn-secondary mb-5 disabled">{{ $order->status }}</button>
                    @elseif (empty($order->payment_proof))
                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label">Bukti Transfer</label>
                        <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer"
                            accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Bayar Pesanan</button>
                    @endif --}}
                    @if ($order->status == 'pending' && empty($order->payment_proof))
                    <!-- Tampilkan form upload dan tombol bayar -->
                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label">Bukti Transfer</label>
                        <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer"
                            accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Bayar Pesanan</button>

                    @else
                    <!-- Tampilkan status sebagai tombol nonaktif -->
                    <button class="btn btn-secondary mb-5 disabled">{{ $order->status }}</button>
                    @endif
                    <br>
                    @if ($order->payment_proof)
                    <img src="{{ asset('PaymentProof/' . $order->payment_proof) }}" alt="Bukti Transfer"
                        class="img-fluid">
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection