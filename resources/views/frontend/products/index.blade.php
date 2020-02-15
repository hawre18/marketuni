@extends('frontend.layout.master-product')
@section('content')
    <div class="container">
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
                                <li><b>برند :</b> <span itemprop="brand">{{$product->brand->title}}</span></li>
                                <li><b>کد محصول :</b> <span itemprop="mpn">{{$product->sku}}</span>
                                    @if(Auth::user())
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
                                        @endif
                                </li>
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
                                </div>
                            </div>
                        @else
                                <span class="label-danger">ناموجود</span>
                            @endif
                            <div id="appo" style="direction: ltr;" class="starratep">
                                @if(Auth::check())
                                <span>لطفا به محصول امتیاز دهید</span>
                                <star-rating :star-size="20" :increment="0.5" v-model="rating"></star-rating>
                                <button @click="setRating()" class="btn btn-primary">ثبت امتیاز</button>
                                    <br/>
                                    <span>امتیاز محصول به انتخاب کاربران</span>
                                    <br/>
                                    <star-rating :inline="true" :read-only="true" :show-rating="false" :star-size="20" v-model="totalRating" :increment="0.1" active-color="#000000"></star-rating>
                                @else
                                <br/>
                                <span>امتیاز محصول به انتخاب کاربران</span>
                                <br/>
                                <star-rating :inline="true" :read-only="true" :show-rating="false" :star-size="20" v-model="totalRating" :increment="0.1" active-color="#000000"></star-rating>
                                <br/>
                                <span>برای افزودن به لیست علاقه مندی ها ابتدا <a href="{{route('register')}}">ثبت نام کنید</a>/<a href="{{route('login')}}">وارد شوید</a></span>
                                    @endif
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
                                                <th>{{$comments->user['name'].' '.$comments->user['last_name']}}<strong class="pull-left">{{\Hekmatinasser\Verta\Verta::instance($comments->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</strong></th>
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
                                                    <th>{{$comments->user['name'].' '.$comments->user['last_name']}}<strong class="pull-left">{{\Hekmatinasser\Verta\Verta::instance($comments->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</strong></th>
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
                </div>
            </div>
            <!--Middle Part End -->
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
