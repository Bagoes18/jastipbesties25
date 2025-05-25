<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Auth;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $product_size = $request->size;
        $product_qty = $request->quantity;

        if (Auth::check()) {
            // User logged in
            $user_id = Auth::id();
            $session_id = null;

            $cartItem = Cart::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->where('product_size', $product_size)
                ->first();
        } else {
            // Guest user
            $user_id = 0;
            $session_id = session()->getId();

            $cartItem = Cart::where('session_id', $session_id)
                ->where('product_id', $product_id)
                ->where('product_size', $product_size)
                ->first();
        }

        if ($cartItem) {
            $cartItem->product_qty += $product_qty;
            $cartItem->save();
        } else {
            Cart::create([
                'session_id' => $session_id,
                'user_id' => $user_id,
                'product_id' => $product_id,
                'product_size' => $product_size,
                'product_qty' => $product_qty
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function cart()
    {
        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $cartItems = Cart::with('product')->where('session_id', session()->getId())->get();
        }

        return view('front.products.cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $cart_id = $request->cart_id;
        $product_qty = $request->product_qty;

        $cartItem = Cart::find($cart_id);
        if ($cartItem) {
            $cartItem->product_qty = $product_qty;
            $cartItem->save();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }

    public function removeFromCart(Request $request)
    {
        $cart_id = $request->cart_id;
        $cartItem = Cart::find($cart_id);
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            $count = Cart::where('user_id', Auth::id())->sum('product_qty');
        } else {
            $count = Cart::where('session_id', session()->getId())->sum('product_qty');
        }

        return response()->json(['count' => $count]);
    }
}