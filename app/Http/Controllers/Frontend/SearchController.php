<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;


class SearchController extends Controller
{
    public function fetch(Request $request)
    {
        $qry=$request->qry;
        return $products=DB::table('products')->where('title','like','%'.$qry.'%')->get();

    }
}
