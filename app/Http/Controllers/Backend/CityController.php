<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=City::with('province')->paginate(10);
        return view('admin.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces=Province::all();
        return view('admin.cities.create',compact('provinces'));
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
            'name' => 'required|unique:cities|min:3|max:255',
        ]);
        try{
            $city=new City();
            $city->name=$request->input('name');
            $city->province_id=$request->input('province_id');
            $city->save();
            Session::flash('city_success','شهر با موفقیت ثبت شد');
            return redirect('/admins/cities');
        }
        catch (\Exception $m){
            Session::flash('city_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/cities');
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
        $provinces=Province::all();
        $city=City::with('province')->whereId($id)->first();
        return view('admin.cities.edit',compact('city','provinces'));
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
            'name' => 'required|unique:cities,name,' . $id .'|min:3|max:255',
            'province_id'=>'required',
        ]);
        try{
            $city=City::findorfail($id);
            $city->name=$request->input('name');
            $city->province_id=$request->input('province_id');
            $city->save();
            Session::flash('city_success','شهر با موفقیت ویرایش شد');
            return redirect('/admins/cities');
        }
        catch (\Exception $m){
            Session::flash('city_error','خطایی در ویرایش به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/cities');
        }
    }
    public function delete($id)
    {
        try{
            $city=City::findorfail($id);
            $city->delete();
            Session::flash('city_success','شهر با موفقیت حذف شد');
            return redirect('/admins/cities');}
        catch (\Exception $m) {
            Session::flash('city_error', 'خطایی در حذف به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/cities');
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
