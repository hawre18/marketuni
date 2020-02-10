<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class LiveSearchController extends Controller
{
    public function fetch(Request $request)
    {
        if($request->get('query')){
            $query=$request->get('query');
            $data=Product::where('title','LIKE',$request->query.'%')->get();
            $output='<ul class="dropdown-menu" style="display:block; position:relative;">';
            foreach ($data as $row){
                $output .='<li><a href="{{route('.'products.single'.'['.'id'.'=>'.$row->id.'])}}'.'">'.$row->title .' '. $row->sku .'</a></li>';
            }
            $output .='</ul>';
            echo $output;
        }
    }
}
