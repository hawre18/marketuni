<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $matchThese = ['status' => 1, 'sents' => 0];
        $neworders=Order::where($matchThese)->count();
        $unpaidorders=Order::where('status',0)->count();
        $from = new Carbon('last week');
        $to=Carbon::today();
        $newusers=User::whereBetween('created_at',[$from, $to])->count();
        return view('admin.main.index',compact(['unpaidorders','neworders','newusers']));
    }
}
