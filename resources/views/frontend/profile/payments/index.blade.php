@extends('frontend.layout.master')
@section('content')
    <div class="row center-block">
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
            <div id="content" class="col-sm-6">
                <div class="header-row text-center">
                    <h3>آدرس ها</h3>
                    <hr/>
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th class="text-center">شناسه</th>
                                    <th class="text-center">سفارش</th>
                                    <th class="text-center">تاریخ پرداخت</th>
                                    <th class="text-center">وضعیت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td class="text-center">{{$loop->index+1}}</td>
                                        <td class="text-center">{{$payment->order_id}}</td>
                                        <td class="text-center">{{$payment->created_at}}</td>
                                        @if($payment->status=='OK')
                                            <td class="text-center label label-success">موفق</td>
                                        @else
                                            <td class="text-center label label-danger">ناموفق</td>
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
