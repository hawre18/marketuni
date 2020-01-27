@extends('frontend.layout.master')
@section('content')
<div class="row center-block">
    @if(Session::has('success'))
        <div class="alert alert-danger">
            <div>{{Session('success')}}</div>
        </div>
    @endif
    <aside id="column-right" class="col-sm-3 hidden-xs">
        <h3 class="subtitle">حساب کاربری</h3>
        <div class="list-group">
            <ul class="list-item">
                <li><a href="login.html">ورود</a></li>
                <li><a href="register.html">ثبت نام</a></li>
                <li><a href="#">فراموشی رمز عبور</a></li>
                <li><a href="#">حساب کاربری</a></li>
                <li><a href="#">لیست آدرس ها</a></li>
                <li><a href="wishlist.html">لیست علاقه مندی</a></li>
                <li><a href="{{route('profile.orders')}}">تاریخچه سفارشات</a></li>
                <li><a href="#">دانلود ها</a></li>
                <li><a href="#">امتیازات خرید</a></li>
                <li><a href="#">بازگشت</a></li>
                <li><a href="#">تراکنش ها</a></li>
                <li><a href="#">خبرنامه</a></li>
                <li><a href="#">پرداخت های تکرار شونده</a></li>
            </ul>
        </div>
    </aside>
    <div id="content" class="col-sm-9">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">لیست محصولات سفارش {{$order->id}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">تصویر محصولات</th>
                            <th class="text-center">نام محصولات</th>
                            <th class="text-center">تعداد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td class="text-center"><img width="15%" src="{{$product->photos[0]->path}}"></td>
                                <td class="text-center">{{$product->title}}</td>
                                <td class="text-center">{{$product->pivot->qty}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="customer-data">
                        <p><strong>نام خریدار: </strong>{{$order->user->name . ' '.$order->user->last_name}}</p>
                        <p><strong>آدرس خریدار: </strong>{{$order->province->name . ' '.$order->city->name . ' '.$order->addresstxt}}</p>
                        <p><strong>کدپستی خریدار: </strong>{{$order->post_code}}</p>
                        <p><strong>شماره موبایل خریدار: </strong>{{$order->user->phone}}</p>
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
