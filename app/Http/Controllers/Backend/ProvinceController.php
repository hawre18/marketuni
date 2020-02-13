<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces=Province::paginate(10);
        return view('admin.provinces.index',compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provinces.create');
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
            'name' => 'required|unique:province|min:3|max:255',
        ]);
        try{
            $province=new Province();
            $province->name=$request->input('name');
            $province->save();
            Session::flash('province_success','استان با موفقیت ثبت شد');
            return redirect('/admins/province');
        }
        catch (\Exception $m){
            Session::flash('province_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/province');
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
        $province=Province::findorfail($id)->first();
        return view('admin.provinces.edit',compact('province'));
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
            'name' => 'required|unique:provinces,name,' . $id .'|min:3|max:255',
        ]);
        try{
            $province=Province::findorfail($id);
            $province->name=$request->input('name');
            $province->save();
            Session::flash('province_success','استان با موفقیت ویرایش شد');
            return redirect('/admins/province');
        }
        catch (\Exception $m){
            Session::flash('province_error','خطایی در ویرایش به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/province');
        }
    }
    public function delete($id)
    {
        try{
            $province=Province::findorfail($id);
            $province->delete();
            Session::flash('province_success','استان با موفقیت حذف شد');
            return redirect('/admins/province');
        }
        catch (\Exception $m) {
            Session::flash('province_error', 'خطایی در حذف به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/province');
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
