<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RequestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\AdminsRole;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;


class PesananController extends Controller
{
    public function pesanan()
    {
        Session::put("page", 'pesanan');

        $pesananModuleCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'pesanan'])->count();
        $pesananModul = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $pesananModul['view_access'] = 1;
            $pesananModul['edit_access'] = 1;
            $pesananModul['full_access'] = 1;
        } else if ($pesananModuleCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $pesananModul = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'pesanan'])->first()->toArray();
        }

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
        // dd($orderSummaries);
        return view('admin.pesanan', compact('orderSummaries', 'pesananModul'));
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
        $requestModuleCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'request'])->count();
        $requestModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $requestModule['view_access'] = 1;
            $requestModule['edit_access'] = 1;
            $requestModule['full_access'] = 1;
        } else if ($requestModuleCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $requestModule = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'request'])->first()->toArray();
        }
        $request = RequestProduct::all();
        return view('admin.request', compact('request', 'requestModule'));
    }

    public function laporan()
    {
        Session::put("page", 'laporan');
        $laporanModuleCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'laporan'])->count();
        $laporanModule = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $laporanModule['view_access'] = 1;
            $laporanModule['edit_access'] = 1;
            $laporanModule['full_access'] = 1;
        } else if ($laporanModuleCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $laporanModule = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'laporan'])->first()->toArray();
        }
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
        return view('admin.laporan', compact('orderSummaries', 'laporanModule'));
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
