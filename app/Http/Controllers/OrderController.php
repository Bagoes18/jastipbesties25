<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders = Order::where('user_id', auth()->user()->id)->where('status', null)->with('atribute', 'product')->get();
        $payment = PaymentMethod::all();
        return view('front.order', compact('orders', 'payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
        $orders = Order::where('user_id', auth()->id())
            ->whereNotNull('status')
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
}
