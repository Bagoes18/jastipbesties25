<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $orders->first()->checkout_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            max-height: 30px;
            max-width: 120px;
            object-fit: contain;
        }

        .header .date {
            font-size: 12px;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        h2,
        p {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <div>
            <img src="{{ public_path('front/img/logo.png') }}" alt="Logo">
        </div>
        <div class="date">
            <p><strong>Tanggal Pemesanan:</strong><br>
                {{ \Carbon\Carbon::parse($orders->first()->created_at)->format('d-m-Y') }}
            </p>
        </div>
    </div>

    <h2>Invoice #{{ $orders->first()->checkout_id }}</h2>
    <p>Pelanggan: {{ $user->name }}</p>
    <p>Alamat: {{ $user->alamat }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->product->product_name }}</td>
                <td>{{ $order->atribute->size ?? '-' }}</td>
                <td>Rp {{ number_format($order->attribute->price ?? $order->product->final_price, 0, ',', '.') }}</td>
                <td>{{ $order->qty }}</td>
                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><strong>Total Keseluruhan</strong></td>
                <td><strong>Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>