<?php

namespace App\Http\Controllers\Backend;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=Coupon::paginate(10);
        return view('admin.coupons.index',compact(['coupons']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'code' => 'required|uniq:coupons',
            'price' => 'required',
        ]);
        try {
            $coupon = new Coupon();
            $coupon->title = $request->title;
            $coupon->code = $request->code;
            $coupon->price = $request->price;
            $coupon->status = $request->status;
            $coupon->save();
            Session::flash('coupon_success', 'کد تخفیف با موفقیت ثبت شد');
            return redirect('/admins/coupons');
        }
        catch (\Exception $m) {
            Session::flash('coupon_error', 'خطایی در ثب به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/coupons');
        }
    }

    public function action($id,$status)
    {
        try{
            if($status==1) {
                DB::table('coupons')
                    ->where('id', $id)
                    ->update(array('status' => 1));
                Session::flash('one_status', 'کوپن با موفقیت منتشر شد');
                return redirect()->back();
            }elseif ($status==0) {
                DB::table('coupons')
                    ->where('id', $id)
                    ->update(array('status' => 0));
                Session::flash('zero_status', 'کوپن با موفقیت منقضی شد');
                return redirect()->back();
            }
        }
        catch (\Exception $m){
            Session::flash('status_error','خطایی در انجام عملیات روی  کوپن به وجود آمده لطفا مجددا تلاش کنید');
            return redirect()->back();
        }
    }    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findorfail($id);
        return view('admin.coupons.edit', compact(['coupon']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'code' => 'required|unique:coupons,code,' . $id,
            'price' => 'required',
        ]);
        try {
            $coupon = Coupon::findorfail($id);
            $coupon->title = $request->title;
            $coupon->code = $request->code;
            $coupon->price = $request->price;
            $coupon->status = $request->status;
            $coupon->save();
            Session::flash('coupon_success', 'کد تخفیف با موفقیت بروز شد');
            return redirect('/admins/coupons');
        }
        catch (\Exception $m) {
            Session::flash('coupon_error', 'خطایی در ,یرایش به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/coupons');
        }
    }

    public function delete($id)
    {
        try{
        $coupon=Coupon::findorfail($id);
        $coupon->delete();
        Session::flash('coupon_success', 'کد تخفیف با موفقیت حذف شد');
            return redirect('/admins/coupons');
        }
        catch (\Exception $m) {
            Session::flash('coupon_error', 'حذف انجام نشد');
            return redirect('/admins/coupons');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
