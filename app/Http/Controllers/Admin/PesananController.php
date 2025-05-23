<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RequestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;


class PesananController extends Controller
{
    public function pesanan()
    {
        Session::put("page", 'pesanan');

        $orders = Order::whereNotNull('status')
            ->with('payment')
            ->get();

        // Group by checkout_id
        $groupedOrders = $orders->groupBy('checkout_id');

        // Hitung total dan jumlah per checkout_id
        $orderSummaries = $groupedOrders->map(function ($group) {
            return [
                'total' => $group->sum('total'),        // Total semua order dalam 1 checkout
                'count' => $group->count(),             // Jumlah order dalam 1 checkout
                'orders' => $group                      // Order detail jika ingin ditampilkan
            ];
        });
        return view('admin.pesanan', compact('orderSummaries'));
    }
    public function acceptPayment($id)
    {
        $order = Order::where('checkout_id', $id)->get();
        foreach ($order as $o) {
            $o->status = 'Diterima';
            $o->save();
        }
        return redirect()->back();
    }
    public function rejectPayment($id)
    {
        $order = Order::where('checkout_id', $id)->get();
        foreach ($order as $o) {
            $o->status = 'Ditolak';
            $o->save();
        }
        return redirect()->back();
    }
    public function request()
    {
        Session::put("page", 'request');
        $request = RequestProduct::all();
        return view('admin.request', compact('request'));
    }

    public function laporan()
    {
        Session::put("page", 'laporan');

        $orders = Order::whereNotNull('status')
            ->with('payment', 'user', 'product')
            ->get();

        // Group by checkout_id
        $groupedOrders = $orders->groupBy('checkout_id');

        // Hitung total dan jumlah per checkout_id
        $orderSummaries = $groupedOrders->map(function ($group) {
            return [
                'total' => $group->sum('total'),        // Total semua order dalam 1 checkout
                'count' => $group->count(),             // Jumlah order dalam 1 checkout
                'orders' => $group                      // Order detail jika ingin ditampilkan
            ];
        });
        return view('admin.laporan', compact('orderSummaries'));
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
