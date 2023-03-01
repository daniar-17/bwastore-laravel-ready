<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();
        $carts_val = User::findOrFail(Auth::user()->id);
        return view('pages/cart', compact('carts','carts_val'));
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart')->with('status','Product Berhasil diHapus !!');
    }

    public function success()
    {
        return view('pages/success');
    }
}
