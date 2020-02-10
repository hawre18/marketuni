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
                <li><a href="{{route('addresses.index')}}">لیست آدرس ها</a></li>
                <li><a href="{{route('favorites.index')}}">لیست علاقه مندی</a></li>
                <li><a href="{{route('orders.index')}}">تاریخچه سفارشات</a></li>
                <li><a href="{{route('payments.index')}}">تراکنش ها</a></li>
            </ul>
        </div>
    </aside>
    <div id="content" class="col-sm-9">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="header-row text-center">
                    <h3>محصولات سفارش {{$order->id}}</h3>
                    <hr/>
                </div>
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
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
