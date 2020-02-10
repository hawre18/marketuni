@extends('frontend.layout.master')
@section('content')
    <div id="app">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li><a href="cart.html">سبد خرید</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                @if(Session::has('coupon_success'))
                     <div class="alert alert-danger">
                          <div>{{Session('coupon_success')}}</div>
                     </div>
                @elseif(Session::has('coupon_expired'))
                    <div class="alert alert-danger">
                        <div>{{Session('coupon_expired')}}</div>
                    </div>
                @endif
                <!--Middle Part Start-->
                <div id="content" class="col-sm-12">
                    <h1 class="title">سبد خرید</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-center">تصویر</td>
                                <td class="text-left">نام محصول</td>
                                <td class="text-left">کد محصول</td>
                                <td class="text-left">تعداد</td>
                                <td class="text-right">قیمت واحد</td>
                                <td class="text-right">کل</td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($cart->items as $product)
                                    <tr>
                                        <td class="text-center"><a href="#"><img src="{{$product['item']->photos[0]->path}}" class="img-thumbnail" /></a></td>
                                        <td class="text-left"><a href="#">{{$product['item']->title}}</a><br /></td>
                                        <td class="text-left"><a href="#">{{$product['item']->sku}}</a><br /></td>
                                        <td class="text-left"><div class="input-group btn-block quantity">
                                                <a data-toggle="tooltip" title="اضافه" href="{{route('cart.add',['id'=>$product['item']->id])}}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                <button type="button" data-toggle="tooltip" title="کم کردن" class="btn btn-danger" onClick="event.preventDefault();
                                                        document.getElementById('remove-cart-item_{{$product['item']->id}}').submit();"><i class="fa fa-minus"></i></button>
                                                <form id="remove-cart-item_{{$product['item']->id}}" action="{{ route('cart.remove',['id'=>$product['item']->id]) }}" method="post" style="display: none;">
                                                    @csrf
                                                </form>
                                                     <p>تعداد: <span class="label label-success">{{$product['qty']}}</span></p>
                                                </div>
                                        </td>
                                        <td class="text-right">{{$product['item']->discount_price?$product['item']->discount_price:$product['item']->price}} تومان</td>
                                        <td class="text-right">{{$product['price']}} تومان</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h2 class="subtitle">حالا مایلید چه کاری انجام دهید؟</h2>
                    <p>در صورتی که کد تخفیف در اختیار دارید میتوانید از آن در اینجا استفاده کنید.</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">استفاده از کوپن تخفیف</h4>
                                </div>
                                <div id="collapse-coupo n" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <label class="col-sm-4 control-label" for="input-coupon">کد تخفیف خود را در اینجا وارد کنید</label>
                                        <form action="{{ route('coupon.add')}}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                    <input type="text" name="code" placeholder="کد تخفیف خود را در اینجا وارد کنید" class="form-control"/>
                                                    <button type="submit" class="btn btn-primary">اعمال تخفیف</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">هزینه ارسال</h4>
                        </div>
                        <div id="collapse-shipping" class="panel-collapse collapse in">
                            @if(Auth::check())
                                <div class="panel-body">
                                    @if(count($addresses)>0)
                                        <p>آدرس تحویل خرید خود را انتخاب کنید</p>
                                         <div class="form-group required">
                                             <label class="col-sm-2 control-label" for="address-1">انتخاب آدرس</label>
                                                 @foreach($addresses as $address)
                                                     <br>
                                                 <form id="address" action="{{route('order.verify')}}" method="get">
                                                 <input type="radio" name="address" value="{{$address->id}}" id="address-1" />{{$address->province['name']. ' '.$address->city['name']. ' '.$address->address}}
                                                     <div class="pull-left"><button type="submit" class="btn btn-primary">تسویه حساب</button></div>
                                                 </form>
                                                 @endforeach
                                         </div>
                                    @else
                                        <p>آدرسی موجود نیست لطفا ابتدا آدرس را در پروفایل خود ثبت کنید</p>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="address-1">انتخاب آدرس</label>
                                            <a class="btn btn-primary" href="{{route('address.create')}}">ثبت آدرس</a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="panel-body">
                                    <p>آدرس تحویل خرید خود را انتخاب کنید</p>
                                    <div class="form-group required">
                                        <p>ابتدا <a href="{{route('login')}}">وارد</a> حساب کاربری خود شوید</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div> <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-right"><strong>جمع کل</strong></td>
                                    <td class="text-right">{{Session::get('cart')->totalPurePrice}} تومان</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>کسر هدیه</strong></td>
                                    <td class="text-right">{{Session::get('cart')->totalDiscountPrice}} تومان</td>
                                </tr>
                                @if(Auth::check()&&Session::get('cart')->coupon)
                                    <tr>
                                        <td class="text-right"><strong>{{Session::get('cart')->coupon['coupon']->title}}</strong></td>
                                        <td class="text-right">{{Session::get('cart')->couponDiscount}} تومان</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="text-right"><strong>هزینه ارسال</strong></td>
                                    <td class="text-right">{{Session::get('cart')->shippingCost}} تومان</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>قابل پرداخت</strong></td>
                                    <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">ادامه خرید</a></div>
                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
@endsection
