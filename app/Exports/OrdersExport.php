<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $orders = Order::with('payment', 'product', 'atribute', 'user')->get();

        return $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'order_date' => $order->created_at,
                'user' => $order->user->name,
                'payment_method' => $order->payment->name ?? 'N/A',
                'product_name' => $order->product->product_name ?? 'N/A',
                'quantity' => $order->qty,
                'status' => $order->status,
                'atribute' => $order->atribute->size ?? '',
                'total' => $order->total ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Order Date',
            'User',
            'Payment Method',
            'Product Name',
            'Quantity',
            'Status',
            'Atribute',
            'Total',
        ];
    }
}

