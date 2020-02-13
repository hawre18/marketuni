<?php

namespace App\Http\Controllers\Frontend;

use App\AttributeGroup;
use App\Category;
use App\Comment;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;
use App\Http\Resources\Rating as RatingResource;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProduct($id)
    {
        $product=Product::with(['photos','attributeValues.attributeGroup','brand','categories'])->whereId($id)->first();
        $commentsProduct=Comment::with('user')->whereProduct_id($id)->orderBy('created_at','desc')
            ->whereStatus('1')->get();
        $relatedProducts=Product::with('categories')->whereHas('categories',function ($q)use($product){
            $q->whereIn('id',$product->categories);
        })->get();
        return view('frontend.products.index',compact(['product','relatedProducts','commentsProduct']));
    }

    public function getProductByCategory($id)
    {
        $category=Category::whereId($id)->first();
        return view('frontend.categories.index',compact(['category','categories']));
    }
    public function apiGetProduct($id)
    {
        $products=Product::with('photos')->whereHas('categories',function ($q)use($id){
            $q->where('id',$id);
        })->paginate(10);
        $response=[
            'products'=>$products
        ];
        return response()->json($response,200);

    }
    public function apiGetSortedProduct($id,$sort,$paginate)
    {
        $products=Product::with('photos')->whereHas('categories',function ($q)use($id){
            $q->where('id',$id);
        })->orderBy('price',$sort)
            ->paginate($paginate);
        $response=[
            'products'=>$products
        ];
        return response()->json($response,200);

    }

    public function apiGetCategoryAttributes($id)
    {
        $attributeGroups=AttributeGroup::with('attributeValue')
            ->whereHas('categories',function ($q)use ($id){
                $q->where('category_id',$id);
            })->get();
        $response=[
            'attributeGroups'=>$attributeGroups
        ];
        return response()->json($response,200);

    }

    public function apiGetFilterProducts($id,$sort,$paginate,$attributes)
    {
        $attributesArray=json_decode($attributes,true);
        $products=Product::with('photos')->whereHas('categories',function ($q)use($id){
            $q->where('id',$id);
        })->whereHas('attributeValues',function ($q)use ($attributesArray){
           $q->whereIn('attributeValue_id',$attributesArray);
        })
            ->orderBy('price',$sort)
            ->paginate($paginate);
        $response=[
            'products'=>$products
        ];
        return response()->json($response,200);

    }

    public function setRating(Request $request)
    {
        return new RatingResource(Rating::create([
            'product_id'=>$request->get('product'),
            'user_id'=>$request->get('user'),
            'rating'=>$request->get('rating')
        ]));
    }

    public function getRating($id)
    {
        return RatingResource::collection(Rating::all()->where('product_id',$id));
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
}
