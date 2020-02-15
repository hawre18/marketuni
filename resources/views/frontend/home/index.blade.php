@extends('frontend.layout.master')

@section('content')
    <div id="container">
<form method="post" action=""></form>
        <div class="container">
            <div class="row">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <div>{{Session('success')}}</div>
                    </div>
                @endif
                <!--Middle Part Start-->
                <div id="content" class="col-xs-12">
                    <!-- Slideshow Start-->
                    <div class="slideshow single-slider owl-carousel" >
                        @foreach($slides as $slide)
                            @foreach($slide->photos as $photo)
                            <div class="item"><img class="img-responsive" src="{{$photo->path}}" alt="banner 2" /></div>
                            @endforeach
                        @endforeach
                    </div>
                    <!-- Slideshow End-->
                    <!-- محصولات Tab Start -->
                    <div id="product-tab" class="product-tab">
                        <ul id="tabs" class="tabs"style="border-color: #0f4c75;">
                            <li><a href="#tab-latest"style="border-color: #0f4c75;">جدیدترین</a></li>
                            <li><a href="#tab-featured"style="border-color: #0f4c75;">ویژه</a></li>
                            <li><a href="#tab-bestseller"style="border-color: #0f4c75;">پرفروش</a></li>
                        </ul>
                        <div id="tab-latest" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($latestProduct as $product)
                                    <div class="product-thumb">
                                        <div class="image"><a href="{{route('products.single',['id'=>$product->id])}}"><img src="{{$product->photos[0]->path}}" alt="{{$product->title}}" title="{{$product->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="{{route('products.single',['id'=>$product->id])}}">{{$product->title}}</a></h4>
                                            @if($product->discount_price)
                                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->discount_price*100))}}%</span></p>
                                            @else
                                                <p class="price"> {{$product->price}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <a class="btn-primary" href="{{route('cart.add',['id'=>$product->id])}}"><span>افزودن به سبد</span></a>
                                            @if(Auth::user())
                                                <div class="add-to-links">
                                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$product->id}}').submit();">
                                                        @if(count(App\Favorite::whereProduct_id($product->id)->whereUser_id(Auth::user()->id)->get())>0)
                                                            <i title="حذف از علاقه مندی" class="fa fa-heart"></i>
                                                        @else
                                                            <i title="افزودن به علاقه مندی" class="fa fa-heart-o"></i>
                                                        @endif
                                                        <form id="favorite-form-{{$product->id}}" method="post"
                                                              action="{{route('favorite.add',$product->id)}}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-featured" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($featuredProduct as $product)
                                    <div class="product-thumb">
                                        <div class="image"><a href="{{route('products.single',['id'=>$product->id])}}"><img src="{{$product->photos[0]->path}}" alt="{{$product->title}}" title="{{$product->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="{{route('products.single',['id'=>$product->id])}}">{{$product->title}}</a></h4>
                                            @if($product->discount_price)
                                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->discount_price*100))}}%</span></p>
                                            @else
                                                <p class="price"> {{$product->price}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <a class="btn-primary" href="{{route('cart.add',['id'=>$product->id])}}"><span>افزودن به سبد</span></a>
                                            @if(Auth::user())
                                                <div class="add-to-links">
                                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$product->id}}').submit();">
                                                        @if(count(App\Favorite::whereProduct_id($product->id)->whereUser_id(Auth::user()->id)->get())>0)
                                                            <i title="حذف از علاقه مندی" class="fa fa-heart"></i>
                                                        @else
                                                            <i title="افزودن به علاقه مندی" class="fa fa-heart-o"></i>
                                                        @endif
                                                        <form id="favorite-form-{{$product->id}}" method="post"
                                                              action="{{route('favorite.add',$product->id)}}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <div id="tab-bestseller" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($bestSeller as $product)
                                    <div class="product-thumb">
                                        <div class="image"><a href="{{route('products.single',['id'=>$product->id])}}"><img src="{{$product->photos[0]->path}}" alt="{{$product->title}}" title="{{$product->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="{{route('products.single',['id'=>$product->id])}}">{{$product->title}}</a></h4>
                                            @if($product->discount_price)
                                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->discount_price*100))}}%</span></p>
                                            @else
                                                <p class="price"> {{$product->price}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <a class="btn-primary" href="{{route('cart.add',['id'=>$product->id])}}"><span>افزودن به سبد</span></a>
                                            @if(Auth::user())
                                                <div class="add-to-links">
                                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$product->id}}').submit();">
                                                        @if(count(App\Favorite::whereProduct_id($product->id)->whereUser_id(Auth::user()->id)->get())>0)
                                                            <i title="حذف از علاقه مندی" class="fa fa-heart"></i>
                                                        @else
                                                            <i title="افزودن به علاقه مندی" class="fa fa-heart-o"></i>
                                                        @endif
                                                        <form id="favorite-form-{{$product->id}}" method="post"
                                                              action="{{route('favorite.add',$product->id)}}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>    <!-- محصولات Tab Start -->
                    <!-- برند Logo Carousel Start-->
                    <h3 class="card-header-tabs">برندها</h3>
                    <div id="carousel" class="owl-carousel nxt">
                        @foreach($brands as $brand)
                            <div class="item image"> <a href="{{route('category.single',['id'=>$brand->id])}}"><img class="img-responsive"  src="{{$brand->photo->path}}"/></a> </div>
                        @endforeach
                         </div>
                    <!-- برند Logo Carousel End -->
                </div>
                <!--Middle Part End-->
            </div>
        </div>
    </div>
@endsection
