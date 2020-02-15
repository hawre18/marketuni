<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
        ]);
        try{
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if (!$cart) {
            Session::flash('warning', 'سبد خرید شما خالی است');
            return redirect('/');
        } else
            {
                 $productId = [];
                 foreach ($cart->items as $product) {
                     $productId[$product['item']->id] = ['qty' => $product['qty']];
                 }
                $order = new Order();
                $order->amount = $cart->totalPrice;
                $order->user_id = Auth::user()->id;
                $order->status = 0;
                $order->address_id=$request->input('address');
                $order->save();
                $order->products()->sync($productId);
                $payment=new Payment($order->amount,$order->id);
                $result=$payment->doPayment();
                if ($result->Status == 100){
                    return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
                }
                else {
                    Session::flash('verify_error','عملیات پرداخت ممکن نیست');
                }
            }
        } catch (\Exception $m){
            Session::flash('verify_error','خطایی در ثبت سفارش به وجود آمده لطفا مجددا تلاش کنید');
            return redirect()->back();
        }
    }
    public function index()
    {
        $orders=Order::where('user_id',Auth::user()->id)->paginate(10);
        return view('frontend.profile.orders.orders',compact(['orders']));
    }

    public function getOrderLists($id)
    {
        $order=Order::whereId($id)->first();
        return view('frontend.profile.orders.lists',compact(['order']));
    }
}
