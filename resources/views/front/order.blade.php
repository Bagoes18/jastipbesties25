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
                        <h4>Keranjang</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Beranda</a>
                            <span> / Keranjang</span>
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
                                <th scope="col">
                                    <input type="checkbox" id="checkAll" onclick="toggleAll(this)">
                                </th>
                                <th scope="col">Product</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $totalPerItem =
                                        ($order->atribute->price ?? $order->product->final_price) * $order->qty;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="order_id[]" value="{{ $order->id }}"
                                            class="item-checkbox" data-total="{{ $totalPerItem }}">
                                    </td>
                                    <td>{{ $order->product->product_name }}</td>
                                    <td>Rp
                                        {{ number_format($order->atribute->price ?? $order->product->final_price, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $order->qty }}</td>
                                    <td>{{ $order->atribute->size ?? '' }} {{ $order->atribute->color ?? '' }}</td>
                                    <td>Rp {{ number_format($totalPerItem, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('delete.order', $order->id) }}" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <strong>Total Harga Dipilih: </strong> <span id="totalHarga">Rp 0</span>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#myModal">Checkout</button>

                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Payment Method</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    @foreach ($payment as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment" id="payment"
                                                value="{{ $item->id }}" required>
                                            <label class="form-check-label" for="payment">{{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    function toggleAll(source) {
                        const checkboxes = document.querySelectorAll('.item-checkbox');
                        checkboxes.forEach(cb => {
                            cb.checked = source.checked;
                        });
                        updateTotal();
                    }

                    function updateTotal() {
                        let total = 0;
                        document.querySelectorAll('.item-checkbox:checked').forEach(cb => {
                            total += parseFloat(cb.dataset.total);
                        });

                        // Format ke "Rp 1.000.000"
                        document.getElementById('totalHarga').innerText = formatRupiah(total);
                    }

                    function formatRupiah(angka) {
                        return 'Rp ' + angka.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }

                    // Event listener untuk semua checkbox item
                    document.querySelectorAll('.item-checkbox').forEach(cb => {
                        cb.addEventListener('change', updateTotal);
                    });

                    // Inisialisasi total (jaga-jaga jika ada yang sudah dicentang)
                    updateTotal();
                </script>


            </div>

        </div>
    </div>
@endsection
