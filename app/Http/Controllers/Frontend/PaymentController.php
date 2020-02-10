<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use App\PaymentIndex;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function verify(Request $request,$id)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        $payment=new Payment($cart->totalPrice);
        $result= $payment->verifyPayment($request->Authority,$request->Status);
        if ($result){
            DB::table('orders')
                ->where('id', $id)
                ->update(array('status' => 1));
            foreach ($cart->items as $product) {
                $products=Product::where('id',$product['item']->id)
                    ->update([
                        'count_sells'=> DB::raw('count_sells+1'),
                    ]);
            }
            $newPayment=new Payment($cart->totalPrice);
            $newPayment->authority=$request->Authority;
            $newPayment->status=$request->Status;
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

    public function index()
    {
        $payments=PaymentIndex::where('user_id',Auth::user()->id)->paginate(10);
        return view('frontend.profile.payments.index',compact(['payments']));
    }
}
