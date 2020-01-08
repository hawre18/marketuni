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
                <h3 class="box-title pull-right">سفارشات</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th >مبلغ</th>
                            <th >وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center"><a href="{{route('profile.orders.lists',['id'=>$order->id])}}">{{$order->id}}</a></td>
                                <td class="text-center">{{$order->amount}}</td>
                                @if($order->status==0)
                                    <td class="text-center"><span class="label label-danger">پرداخت نشده</span> </td>
                                @else
                                    <td class="text-center"><span class="label label-success">پرداخت شده</span> </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>

    </div>
</div>
@endsection
