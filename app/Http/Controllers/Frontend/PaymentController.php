<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function verify(Request $request,$id)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        $payment=new Payment($cart->totalPrice);
        $result= $payment->verifyPayment($request->Authority,$request->Status);
        if ($result){
            $order=Order::findorfail($id);
            $order->status=1;
            $order->save();
            $newPayment=new Payment($cart->totalPrice);
            $newPayment->authority=$request->Authority;
            $newPayment->status=$request->Status;
            $newPayment->RefID=$result->RefID;
            $newPayment->order_id=$id;
            $newPayment->save();
            Session::forget('cart');
            Session::flash('success', 'پرداخت شما با موفقیت انجام شد');
            return redirect('/');
        }else{
            Session::flash('warning', 'عملیات پرداخت با خطا روبه رو شده است');
            return redirect('/cart');
        }
    }
}
