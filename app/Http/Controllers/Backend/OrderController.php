<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::orderby('updated_at','desc')->paginate(20);
        return view('admin.orders.index',compact(['orders']));
    }

    public function getOrderLists($id)
    {
        $order=Order::with('user','city','province','products.photos','address')->whereId($id)->first();
        return view('admin.orders.lists',compact(['order']));
    }

    public function send($id)
    {
        DB::table('orders')
            ->where('id', $id)
            ->update(array('sents' => 1));
        return redirect()->back();

    }

    public function newOrder()
    {
        $orders=Order::where('sents',0)->orderby('created_at','asc')->paginate(10);
        return view('admin.orders.index',compact(['orders']));
    }
    public function orderPay($id)
    {
        DB::table('orders')
            ->where('id', $id)
            ->update(array('status' => 1));
        return redirect()->back();
    }

    public function unpaidOrders()
    {
        $orders=Order::where('status',0)->orderby('created_at','asc')->paginate(10);
        return view('admin.orders.index',compact(['orders']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
