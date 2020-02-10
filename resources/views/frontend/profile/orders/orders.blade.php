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
                <li><a href="{{route('payments.list')}}">تراکنش ها</a></li>
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
                            <th class="text-center">مبلغ</th>
                            <th class="text-center">وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center"><a href="{{route('orders.products',['id'=>$order->id])}}">{{$order->id}}</a></td>
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
