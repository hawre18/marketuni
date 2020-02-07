<?php

namespace App\Http\Controllers\Frontend;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites=Favorite::with('product.photos')->get();
        return view('frontend.profile.favorites.index',compact(['favorites']));
    }
    public function favoriteProduct(Product $product)
    {
        $user=Auth::user()->id;
        $isFavorited=Favorite::whereProduct_id($product->id)->where('user_id',$user)->get();
        if (!count($isFavorited)>0){
            $favorite=new Favorite();
            $favorite->user_id=$user;
            $favorite->product_id=$product->id;
            $favorite->save();
            return back();
        }
        elseif (count($isFavorited)>0){
            $isFavorited=Favorite::whereProduct_id($product->id)->where('user_id',$user)->get();
            $favoritedelet=Favorite::findorfail($isFavorited[0]->id);
            $favoritedelet->delete();
            return back();
        }
    }
}
