<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;

use function PHPSTORM_META\map;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put("page", 'order');
        $orders = Order::where('user_id', auth()->user()->id)->where('status', null)->with('atribute', 'product')->get();
        $payment = PaymentMethod::all();
        return view('front.order', compact('orders', 'payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function checkout(Request $request)
    {
        $checkout = time();

        foreach ($request->order_id as $order_id) {
            $order = Order::find($order_id);
            if ($order) {
                $order->checkout_id = $checkout;
                $order->payment_id = $request->payment;
                $order->status = 'pending';

                $totalPerItem = ($order->atribute->price ?? $order->product->final_price) * $order->qty;
                $order->total = $totalPerItem;

                $order->save();
            }
        }

        return redirect()->route('payment.order', $checkout);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->product_id = $request->product_id;
        if ($request->atribute_id) {
            $order->atribute_id = $request->atribute_id;
        }
        $order->qty = $request->qty;
        $order->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $order = Order::find($request->id);
        $order->delete();
        return redirect()->back();
    }


    public function riwayat()
    {
        Session::put("page", 'riwayat');
        $orders = Order::where('user_id', auth()->id())
            ->whereNotNull('status')
            ->with('payment')
            ->get();

        $onproccess = Order::where('status', 'Diterima');

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

        return view('front.riwayat', compact('orderSummaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function printInvoice($checkout_id, $user_id)
    {
        $orders = Order::with(['user', 'product', 'atribute'])
            ->where('checkout_id', $checkout_id)
            ->where('user_id', $user_id)
            ->get();

        if ($orders->isEmpty()) {
            abort(404, 'Order not found');
        }

        // Karena $orders adalah koleksi (banyak), kamu harus sesuaikan view dan looping-nya

        $user = $orders->first()->user; // data user ambil dari order pertama

        $pdf = Pdf::loadView('front.orders.invoice', compact('orders', 'user'))
            ->setPaper('A5', 'portrait');

        return $pdf->download('invoice-order-' . $checkout_id . '.pdf');
    }



}
