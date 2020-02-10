<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
      $product = Product::with('photos')->whereId($id)->first();
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);
      $request->session()->put('cart', $cart);
//      dd($request->session()->get('cart'));
      return back();
    }

    public function removeItem(Request $request, $id){
      $product = Product::findOrFail($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->remove($product, $product->id);
      $request->session()->put('cart', $cart);
      return back();
    }

    public function getCart()
    {
      if (Auth::check()){
      $addresses=Address::with('province','city')->where('user_id',Auth::user()->id)->get();
      }
      $cart = Session::has('cart') ? Session::get('cart') : null;
      return view('frontend.cart.index', compact(['cart','addresses']));
    }
}
