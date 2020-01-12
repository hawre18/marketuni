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
                            <div class="item"> <a href="#"><img class="img-responsive" src="{{$photo->path}}" alt="banner 2" /></a> </div>
                            @endforeach
                        @endforeach
                    </div>
                    <!-- Slideshow End-->
                    <!-- محصولات Tab Start -->
                    <div id="product-tab" class="product-tab">
                        <ul id="tabs" class="tabs"style="border-color: #f8b400;">
                            <li><a href="#tab-latest"style="border-color: #f8b400;">جدیدترین</a></li>
                            <li><a href="#tab-featured"style="border-color: #f8b400;">ویژه</a></li>
                            <li><a href="#tab-bestseller"style="border-color: #f8b400;">پرفروش</a></li>
                        </ul>
                        <div id="tab-latest" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($latestProduct as $product)
                                    <div class="product-thumb">
                                        <div class="image"><a href="{{route('products.single',['id'=>$product->id])}}"><img src="{{$product->photos[0]->path}}" alt="{{$product->title}}" title="{{$product->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="{{route('products.single',['id'=>$product->id])}}">{{$product->title}}</a></h4>
                                            @if($product->discount_price)
                                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->discount_price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->discount_price*100))}}%</span></p>
                                            @else
                                                <p class="price"> {{$product->price}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <a class="btn-primary" href="{{route('cart.add',['id'=>$product->id])}}"><span>افزودن به سبد</span></a>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
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
                                                <p class="price"><span class="price-new">{{$product->discount_price}} تومان</span> <span class="price-old">{{$product->discount_price}} تومان</span><span class="saving">{{round(abs(($product->price-$product->discount_price)/$product->discount_price*100))}}%</span></p>
                                            @else
                                                <p class="price"> {{$product->price}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <a class="btn-primary" href="{{route('cart.add',['id'=>$product->id])}}"><span>افزودن به سبد</span></a>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <div id="tab-bestseller" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                <div class="product-thumb">
                                    <div class="image"><a href="product.html"><img src="image/product/nikon_d300_1-220x330.jpg" alt="دوربین دیجیتال حرفه ای" title="دوربین دیجیتال حرفه ای" class="img-responsive" /></a></div>
                                    <div class="caption">
                                        <h4><a href="product.html">دوربین دیجیتال حرفه ای</a></h4>
                                        <p class="price"> <span class="price-new">92000 تومان</span> <span class="price-old">98000 تومان</span> <span class="saving">-6%</span> </p>
                                    </div>
                                    <div class="button-group">
                                        <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                        <div class="add-to-links">
                                            <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                            <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    <!-- محصولات Tab Start -->
                    <!-- دسته ها محصولات Slider Start-->
                    <div class="category-module" id="latest_category"style="border-color: #f8b400;">
                        <h3 class="subtitle"style="border-color: #f8b400;">مد و زیبایی - <a class="viewall" href="category.tpl" style="border-color: #f8b400;">نمایش همه</a></h3>
                        <div class="category-module-content"style="border-color: #f8b400;">
                            <ul id="sub-cat" class="tabs" style="border-color: #f8b400;">
                                <li><a href="#tab-cat1" style="border-color: #f8b400;">آقایان</a></li>
                                <li><a href="#tab-cat2" style="border-color: #f8b400;">بانوان</a></li>
                                <li><a href="#tab-cat3" style="border-color: #f8b400;">دخترانه</a></li>
                                <li><a href="#tab-cat4" style="border-color: #f8b400;">پسرانه</a></li>
                                <li><a href="#tab-cat5" style="border-color: #f8b400;">نوزاد</a></li>
                                <li><a href="#tab-cat6" style="border-color: #f8b400;">لوازم</a></li>
                            </ul>
                            <div id="tab-cat1" class="tab_content" >
                                <div class="owl-carousel latest_category_tabs">
                                    <div class="product-thumb">
                                        <div class="image"><a href="product.html"><img src="image/product/ipod_touch_1-220x330.jpg" alt="سامسونگ گلکسی s7" title="سامسونگ گلکسی s7" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="product.html">سامسونگ گلکسی s7</a></h4>
                                            <p class="price"> <span class="price-new">62000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-50%</span> </p>
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-cat2" class="tab_content">
                                <div class="owl-carousel latest_category_tabs">
                                    <div class="product-thumb">
                                        <div class="image"><a href="product.html"><img src="image/product/ipod_shuffle_1-220x330.jpg" alt="لپ تاپ hp پاویلیون" title="لپ تاپ hp پاویلیون" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="product.html">لپ تاپ hp پاویلیون</a></h4>
                                            <p class="price"> 122000 تومان </p>
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-cat3" class="tab_content">
                                <div class="owl-carousel latest_category_tabs">
                                    <div class="product-thumb">
                                        <div class="image"><a href="product.html"><img src="image/product/samsung_tab_1-220x330.jpg" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="product.html">تبلت ایسر</a></h4>
                                            <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-cat5" class="tab_content">
                                <div class="owl-carousel latest_category_tabs">
                                    <div class="product-thumb">
                                        <div class="image"><a href="product.html"><img src="image/product/samsung_tab_1-220x330.jpg" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="product.html">تبلت ایسر</a></h4>
                                            <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-cat6" class="tab_content">
                                <div class="owl-carousel latest_category_tabs">
                                    <div class="product-thumb">
                                        <div class="image"><a href="product.html"><img src="image/product/ipod_classic_1-220x330.jpg" alt="آیپاد نسل 5" title="آیپاد نسل 5" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="product.html">آیپاد نسل 5</a></h4>
                                            <p class="price"> 122000 تومان </p>
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" type="button" onClick="cart.add('48');"><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- دسته ها محصولات Slider End-->
                    <!-- برند Logo Carousel Start-->
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
