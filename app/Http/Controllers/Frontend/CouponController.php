<?php

namespace App\Http\Controllers\Frontend;

use App\Cart;
use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function addCoupon(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|min:3|max:255',
        ]);
        try{
        $check=Auth::user()->whereHas('coupons',function ($q) use($request){
            $q->where('code',$request->code);
        })->exists();
        if (!$check){
            $coupon=Coupon::where('code',$request->code)->first();
            $cart = Session::has('cart') ? Session::get('cart') : null;
            $cart=new Cart($cart);
            $cart->addCoupon($coupon);
            $request->session()->put('cart', $cart);
            $user=Auth::user();
            $user->coupons()->attach($coupon->id);
            $user->save();
            Session::flash('expired','شما قبلا از این کد تخفیف استفاده کرده اید');
            return back();
        }else{
            Session::flash('expired','شما قبلا از این کد تخفیف استفاده کرده اید');
            return back();
        }
        } catch (\Exception $m){
            Session::flash('coupon_error','خطایی در استفاده از کد تخفیف به وجود آمده لطفا مجددا تلاش کنید');
            return redirect()->back();
        }
    }

}
