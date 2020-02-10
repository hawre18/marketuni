<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses=Address::with(['city','province'])->where('user_id',Auth::user()->id)->paginate(10);
        return view('frontend.profile.address.index',compact(['addresses']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.profile.address.create');
    }
    public function getAllProvince()
    {
        $provinces=Province::all();
        $response=[
            'provinces'=>$provinces
        ];
        return response()->json($response,200);
    }
    public function getAllCities($provinceId)
    {
        $cities=City::where('province_id',$provinceId)->get();
        $response=[
            'cities'=>$cities
        ];
        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $address = new Address();
            $address->address = $request->input('address');
            $address->company = $request->input('company');
            $address->province_id = $request->input('province');
            $address->city_id = $request->input('city');
            $address->post_code = $request->input('post_code');
            $address->phone = $request->input('phone');
            $address->user_id = Auth::user()->id;
            $address->save();
            Session::flash('address_success','ثبت آدرس با موفقیت انجام شد');
            return redirect('/addresses');
        }catch (Exception $e){
            Session::flash('address_warning','ثبت آدرس با خطا مواجه شد لطفا مجددا تلاش کنید');
            return redirect('/addresses');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address=Address::with('province','city')->whereId($id)->first();
        return view('frontend.profile.address.edit',compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'company' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'province' => 'required',
            'city' => 'required',
            'post_code' => 'required|min:10',
            'phone' => 'required|min:11',
        ]);
        try{
            $address=Address::findorfail($id);
            $address->company=$request->input('company');
            $address->address=$request->input('address');
            $address->province_id=$request->input('province');
            $address->city_id=$request->input('city');
            $address->post_code=$request->input('post_code');
            $address->phone=$request->input('phone');
            $address->user_id=Auth::user()->id;
            $address->save();
            Session::flash('address_success','آدرس با موفقیت ویرایش شد');
            return redirect('/addresses');
        }
        catch (\Exception $m){
            Session::flash('address_error','خطایی در ویرایش به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/addresses');
        }
    }
    public function delete($id)
    {
        try{
            $address=Address::findorfail($id);
            $address->delete();
            Session::flash('address_success','آدرس با موفقیت حذف شد');
            return redirect('/addresses');}
        catch (\Exception $m) {
            Session::flash('address_error', 'خطایی در حذف به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/addresses');
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
