@extends('frontend.layout.master')
@section('content')
    <div id="app" class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <div itemscope>
                    <h1 class="title" itemprop="name">{{$product->title}}</h1>
                    <div class="row product-info">
                        <div class="col-sm-6">
                            <div class="image">
                                <img class="img-responsive" itemprop="image" id="zoom_01" src="{{$product->photos[0]->path}}" data-zoom-image="{{$product->photos[0]->path}}" />
                            </div>
                            <div class="image-additional" id="gallery_01">
                                @foreach($product->photos as $photo)
                                    <a class="thumbnail" href="#" data-zoom-image="{{$photo->path}}" data-image="{{$photo->path}}" > <img src="{{$photo->path}}" /></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled description">
                                <li><b>برند :</b> <a href="#"><span itemprop="brand">{{$product->brand->title}}</span></a></li>
                                <li><b>کد محصول :</b> <span itemprop="mpn">{{$product->slug}}</span></li>
                                @if($product->instock==1)
                                <li><b>وضعیت موجودی :</b>
                                    <span class="instock">موجود</span>
                                </li>
                            </ul>
                            <ul class="price-box">
                                <li class="price" itemprop="offers">
                                    @if(!$product->discount_price==null)
                                        <span itemprop="price">{{$product->discount_price}} تومان</span>
                                        <span class="price-old">{{$product->price}} تومان</span>
                                    @else
                                        <span class="price">{{$product->price}} تومان</span>
                                    @endif
                                </li>
                            </ul>
                            <div id="product">
                                <h3 class="subtitle">انتخاب های در دسترس</h3>
                                <div class="cart">
                                    <div>
                                        <a href="{{route('cart.add',['id'=>$product->id])}}" id="button-cart" class="btn btn-primary btn-lg">افزودن به سبد</a>
                                    </div>
                                   <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$product->id}}').submit();">
                                       <i class="fa fa-heart"></i>
                                       <form id="favorite-form-{{$product->id}}" method="post"
                                             action="{{route('favorite.add',$product->id)}}" style="display: none;">
                                           @csrf
                                       </form>
                                   </a>
                                </div>
                            </div>
                        @else
                                <span class="label-danger">ناموجود</span>
                            @endif
                            <div id="appo" style="direction: ltr;" class="starratep">
                                @if(Auth::check())
                                <span>لطفا به محصول امتیاز دهید</span>
                                <star-rating :star-size="20" :increment="0.5" v-model="rating"></star-rating>
                                <button @click="setRating()" class="btn btn-primary">ثبت نظر</button>
                                @endif
                                <br/>
                                <span>امتیاز محصول به انتخاب کاربران</span>
                                <br/>
                                <star-rating :inline="true" :read-only="true" :show-rating="false" :star-size="20" v-model="totalRating" :increment="0.1" active-color="#000000"></star-rating>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab">توضیحات اصلی</a></li>
                        <li><a href="#tab-specification" data-toggle="tab">مشخصات</a></li>
                        <li><a href="#tab-review" data-toggle="tab"><span>نظرات</span>({{count($commentsProduct)}})</a></li>
                    </ul>
                    <div class="tab-content">
                        <div itemprop="description" id="tab-description" class="tab-pane active">
                            {!! $product->long_description !!}
                        </div>
                        <div id="tab-specification" class="tab-pane">
                            <div id="tab-specification" class="tab-pane">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($product->attributeValues as $attribute)
                                            <tr>
                                                <td>{{$attribute->attributeGroup->title}}</td>
                                                <td>{{$attribute->title}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tab-review" class="tab-pane">
                            @if(Auth::check())
                            <form class="form-horizontal" method="post" action="\comment\store\{{$product->id}}\{{$user_id=Auth::user()->id}}">
                                @csrf
                                <div id="review">
                                    <div>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                            @foreach($commentsProduct as $comments)
                                                <th>{{$comments->user->name.' '.$comments->user->last_name}}<strong class="pull-left">{{\Hekmatinasser\Verta\Verta::instance($comments->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</strong></th>
                                            <tr>
                                                <td>
                                                  {{$comments->description}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-right"></div>
                                </div>
                                <h2>یک نطر ثبت کنید</h2>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="input-review" class="control-label">بررسی شما</label>
                                        <textarea class="form-control" id="input-review" rows="5" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <input type="hidden" name="_method" value="GET">
                                        <button class="btn btn-primary" id="button-review" type="submit">ادامه</button>
                                    </div>
                                </div>
                            </form>
                            @else
                                    <div id="review">
                                        <div>
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                @foreach($commentsProduct as $comments)
                                                    <th>{{$comments->user->name.' '.$comments->user->last_name}}<strong class="pull-left">{{\Hekmatinasser\Verta\Verta::instance($comments->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</strong></th>
                                                    <tr>
                                                        <td>
                                                            {{$comments->description}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-right"></div>
                                    </div>
                                    <div class="text" style="padding-bottom: 5%;">
                                        <div class="col-sm-12 col-md-6">
                                            <span>برای ثبت نظر<a href="{{route('register')}}">ثبت نام</a> کنید</span><span>/</span><span><a href="{{route('login')}}">واردشوید</a></span>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <h3 class="subtitle">محصولات مرتبط</h3>
                    <div class="owl-carousel related_pro">
                        <div class="product-thumb">
                            @foreach($relatedProducts as $product)
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
                </div>
            </div>
            <!--Middle Part End -->
            <!--Right Part Start -->
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">پرفروش ها</h3>
                <div class="side-item">
                    <div class="product-thumb clearfix">
                        <div class="image">
                            <a href="product.html">
                                <img src="/image/product/apple_cinema_30-50x75.jpg" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" />
                            </a>
                        </div>
                        <div class="caption">
                            <h4><a href="product.html">تی شرت کتان مردانه</a></h4>
                            <p class="price"><span class="price-new">110000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-10%</span></p>
                        </div>
                    </div>
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/iphone_1-50x75.jpg" alt="آیفون 7" title="آیفون 7" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">آیفون 7</a></h4>
                            <p class="price"> 2200000 تومان </p>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="list-group">
                    <h3 class="subtitle">محتوای سفارشی</h3>
                    <p>این یک بلاک محتواست. هر نوع محتوایی شامل html، نوشته یا تصویر را میتوانید در آن قرار دهید. </p>
                    <p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                </div>
                <h3 class="subtitle">ویژه</h3>
                <div class="side-item">
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/macbook_pro_1-50x75.jpg" alt=" کتاب آموزش باغبانی " title=" کتاب آموزش باغبانی " class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">کتاب آموزش باغبانی</a></h4>
                            <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">120000 تومان</span> <span class="saving">-26%</span> </p>
                        </div>
                    </div>
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/samsung_tab_1-50x75.jpg" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">تبلت ایسر</a></h4>
                            <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                        </div>
                    </div>
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/apple_cinema_30-50x75.jpg" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="http://demo.harnishdesign.net/opencart/marketshop/v1/index.php?route=product/product&amp;product_id=42">تی شرت کتان مردانه</a></h4>
                            <p class="price"> <span class="price-new">110000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-10%</span> </p>
                        </div>
                    </div>
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/nikon_d300_1-50x75.jpg" alt="دوربین دیجیتال حرفه ای" title="دوربین دیجیتال حرفه ای" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">دوربین دیجیتال حرفه ای</a></h4>
                            <p class="price"> <span class="price-new">92000 تومان</span> <span class="price-old">98000 تومان</span> <span class="saving">-6%</span> </p>
                        </div>
                    </div>
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/nikon_d300_5-50x75.jpg" alt="محصولات مراقبت از مو" title="محصولات مراقبت از مو" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">محصولات مراقبت از مو</a></h4>
                            <p class="price"> <span class="price-new">66000 تومان</span> <span class="price-old">90000 تومان</span> <span class="saving">-27%</span> </p>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                        </div>
                    </div>
                    <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="/image/product/macbook_air_1-50x75.jpg" alt="لپ تاپ ایلین ور" title="لپ تاپ ایلین ور" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">لپ تاپ ایلین ور</a></h4>
                            <p class="price"> <span class="price-new">10 میلیون تومان</span> <span class="price-old">12 میلیون تومان</span> <span class="saving">-5%</span> </p>
                        </div>
                    </div>
                </div>
            </aside>
            <!--Right Part End -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        // Elevate Zoom for Product Page image
        $("#zoom_01").elevateZoom({
            gallery:'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500,
            zoomWindowPosition : 11,
            lensFadeIn: 500,
            lensFadeOut: 500,
            loadingIcon: 'image/progress.gif'
        });
        //////pass the images to swipebox
        $("#zoom_01").bind("click", function(e) {
            var ez =   $('#zoom_01').data('elevateZoom');
            $.swipebox(ez.getGalleryList());
            return false;
        });
    </script>
    <script type="text/javascript">
        new Vue({
            el: '#appo',
            components:{
                'star-rating': VueStarRating.default
            },
            methods: {
                setRating(){
                    var pathArray=location.pathname.split('/');
                    var uid=pathArray[3];
                    const request = new Request('/api/rating/new', {
                        method: 'POST',
                        body:JSON.stringify({product:uid,user:'1',rating:this.rating}),
                        headers: new Headers({
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json'
                        })
                    });
                    fetch(request)

                    .then(res=>res.json())
                    .then(data=>{
                        this.$swal('سپاس','امتیاز شما ثبت شد','success')
                    }).catch(err=>{
                        this.$swal('متاسفم','انگار مشکلی پیش آمده است','warning')
                        console.log(err);
                    });
                },
               getRating() {
                    var pathArray=location.pathname.split('/');
                    var pid=pathArray[3];
                   const request = new Request('/api/rating/'+pid, {
                       method: 'get',
                       headers: new Headers({
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                           'Content-Type': 'application/json'
                       })
                   });
                    fetch(request)
                        .then(res=>res.json())
                        .then(res=>{
                           var mydata=res.data;
                           console.log(mydata.length);
                           var totaluser=mydata.length;
                           var sum=0;
                           for (var i=0;i<mydata.length;i++){
                               sum+=parseFloat(mydata[i]['rating']);
                           }
                           var avg=sum/mydata.length;
                           this.totalRating=parseFloat(avg.toFixed(1));
                        }).catch(err=>{
                        console.log(err);
                    });
                },
                setCurrentSelectedRating: function(rating) {
                    this.currentSelectedRating = "You have Selected: " + rating + " stars";
                },
                reset: function() {
                    this.resetableRating = 0;
                },
                syncRating: function(rating) {
                    this.resetableRating = rating;
                }
            },
            data: {
                boundRating: 2,
                rating:0,
                totalRating:0,
                totalUser:0,
                currentRating: "No Rating",
                currentSelectedRating: "No Current Rating",
                resetableRating: 3,
                isFavorited: '',
                favorites:0,
            },
            created(){
                this.getRating();
            }
        });
    </script>
@endsection
