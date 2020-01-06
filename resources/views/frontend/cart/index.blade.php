@extends('frontend.layout.master')
@section('content')
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li><a href="cart.html">سبد خرید</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                @if(Session::has('expired'))
                    <div class="alert alert-danger">
                        <div>{{Session('expired')}}</div>
                    </div>
                @endif
                    @if(Session::has('warning'))
                        <div class="alert alert-danger">
                            <div>{{Session('warning')}}</div>
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
                                        <form id="coupon-form" action="{{ route('coupon.add')}}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                    <input type="text" name="coupon" value="" placeholder="کد تخفیف خود را در اینجا وارد کنید" id="input-coupon" class="form-control" />
                                                    <button type="submit" id="button-coupon" data-loading-text="بارگذاری ..."  class="btn btn-primary" onclick="event.preventDefault();">اعمال تخفیف</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                   <!-- <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">پیش بینی هزینه ی حمل و نقل و مالیات</h4>
                        </div>
                        <div id="collapse-shipping" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>مقصد خود را جهت براورد هزینه ی 0 تومان وارد کنید.</p>
                                <form class="form-horizontal">
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-country">کشور</label>
                                        <div class="col-sm-10">
                                            <select name="country_id" id="input-country" class="form-control">
                                                <option value=""> --- لطفا انتخاب کنید --- </option>
                                                <option value="244">Aaland Islands</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-zone">شهر / استان</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="input-zone" name="zone_id">
                                                <option value=""> --- لطفا انتخاب کنید --- </option>
                                                <option value="13">Aberdeen</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label" for="input-postcode">کد پستی</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="postcode" value="" placeholder="کد پستی" id="input-postcode" class="form-control" />
                                        </div>
                                    </div>
                                    <input type="button" value="دریافت پیش فاکتور" id="button-quote" data-loading-text="بارگذاری ..." class="btn btn-primary" />
                                </form>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
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
                                @if(Auth::check()&&Session::get('cart')->coupon){
                                    <tr>
                                        <td class="text-right"><strong>{{Session::get('cart')->coupon['coupon']->title}}</strong></td>
                                        <td class="text-right">{{Session::get('cart')->couponDiscount}} تومان</td>
                                    </tr>
                                }@endif
                                <tr>
                                    <td class="text-right"><strong>قابل پرداخت</strong></td>
                                    <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">ادامه خرید</a></div>
                        <div class="pull-right"><a href="{{route('order.verify')}}" class="btn btn-primary">تسویه حساب</a></div>
                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
@endsection
