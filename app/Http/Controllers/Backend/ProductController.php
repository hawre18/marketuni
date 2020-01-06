<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(10);
        return view('admin.products.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=Brand::all();
        return view('admin.products.create',compact(['brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateSKU()
    {
        $number=mt_rand(1000,999999);
        if ($this->checkSKU($number)){
            return $this->generateSKU();
        }
        return (string)$number;
    }

    public function checkSKU($number)
    {
        return Product::where('sku',$number)->exists();
    }

    public function store(Request $request)
    {
        $newProduct=new Product();
        $newProduct->title=$request->title;
        $newProduct->sku=$this->generateSKU();
        $newProduct->slug=$request->slug;
        $newProduct->status=$request->status;
        $newProduct->price=$request->price;
        $newProduct->discount_price=$request->discount_price;
        $newProduct->short_description=$request->short_description;
        $newProduct->long_description=$request->long_description;
        $newProduct->brand_id=$request->brand;
        $newProduct->user_id=1;
        $newProduct->save();
        $attributes=explode(',',$request->input('attributes')[0]);
        $photos=explode(',',$request->input('photo_id')[0]);
        $newProduct->photos()->sync($photos);
        $newProduct->categories()->sync($request->categories);
        $newProduct->attributeValues()->sync($attributes);
        return redirect('admins\products');
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
        $brands=Brand::all();
        $product=Product::with(['attributeValues','brand','categories','photos'])->whereId($id)->first();
        return view('admin.products.edit',compact(['brands',['product']]));
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
        $product=Product::findorfail($id);
        $product->title=$request->title;
        $product->sku=$this->generateSKU();
        $product->slug=$request->slug;
        $product->status=$request->status;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->short_description=$request->short_description;
        $product->long_description=$request->long_description;
        $product->meta_title=$request->meta_title;
        $product->meta_desc=$request->meta_desc;
        $product->meta_keywords=$request->meta_keywords;
        $product->brand_id=$request->brand;
        $product->user_id=1;
        $product->save();
        $attributes=explode(',',$request->input('attributes')[0]);
        $photos=explode(',',$request->input('photo_id')[0]);
        $product->photos()->sync($photos);
        $product->categories()->sync($request->categories);
        $product->attributeValues()->sync($attributes);
        return redirect('admins\products');
    }
    public function delete($id)
    {
        $product=Product::findorfail($id);
        $product->delete();
        return redirect('admins\products');
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
