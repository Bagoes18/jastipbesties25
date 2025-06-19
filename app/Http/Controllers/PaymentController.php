<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        Session::put("page", 'payment');
        $total = Order::where('checkout_id', $id)->sum('total');
        $order = Order::where('checkout_id', $id)->with('payment')->first();

        if (!$order || !$order->payment) {
            return redirect()->back()->with('error', 'Payment not found');
        }

        return view('front.payment', compact('total', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request, $id)
    // {

    //     if ($request->hasFile('bukti_transfer')) {
    //         $image = $request->file('bukti_transfer');
    //         $imageName = $id . '.' . $image->getClientOriginalExtension();
    //         $path = 'storage/PaymentProof/' . $imageName;

    //         // Hapus file lama jika sudah ada
    //         if (Storage::exists($path)) {
    //             Storage::delete($path);
    //         }

    //         // Simpan file baru
    //         $image->storeAs('storage/PaymentProof', $imageName);
    //         $order = Order::where('checkout_id', $id)->first();
    //         $order->payment_proof = $imageName;
    //         $order->save();
    //     } else {
    //         return redirect()->back()->with('error', 'No file uploaded');
    //     }

    //     return redirect()->back()->with('success', 'Payment proof uploaded successfully');
    // }
    public function store(Request $request, $id)
    {
        if ($request->hasFile('bukti_transfer')) {
            $image = $request->file('bukti_transfer');
            $imageName = $id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('front/images/PaymentProof');

            // Pastikan folder ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fullPath = $destinationPath . '/' . $imageName;

            // Hapus file lama jika ada
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            // Resize & simpan dengan Intervention
            $img = Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($fullPath);

            // Simpan nama file ke database
            $order = Order::where('checkout_id', $id)->first();
            $order->payment_proof = $imageName;
            $order->save();

            return redirect()->back()->with('success', 'Bukti Pembayaran Berhasil Terkirim');
        }

        return redirect()->back()->with('error', 'No file uploaded');
    }



    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
