<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function newUsersIndex()
    {
        $from = new Carbon('last week');
        $to=Carbon::today();
        $users=User::whereBetween('created_at',[$from, $to])->orderby('created_at','desc')->paginate(10);
        return view('admin.users.index',compact(['users']));

    }
}
