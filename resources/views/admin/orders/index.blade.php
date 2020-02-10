@extends('admin.layout.master')
@section('content')
    <section class="content" style="direction: rtl">
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
                            <th class="text-center">وضعیت پرداخت</th>
                            <th class="text-center">وضعیت ارسال</th>
                            <th class="text-center">عملیات ارسال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center"><a href="{{route('orders.lists',['id'=>$order->id])}}">{{$order->id}}</a></td>
                                <td class="text-center">{{$order->amount}}</td>
                                @if($order->status==0)
                                <td class="text-center"><span class="label label-danger">پرداخت نشده</span> </td>
                                @else
                                <td class="text-center"><span class="label label-success">پرداخت شده</span> </td>
                                @endif
                                @if($order->sents==0)
                                    <td class="text-center"><span class="label label-danger">ارسال نشده</span> </td>
                                    <td class="text-center"><a class="btn btn-success" href="{{route('order.send',['id'=>$order->id])}}">ارسال کردن</a></td>
                                @else
                                    <td class="text-center"><span class="label label-success">ارسال شده</span> </td>
                                    <td class="text-center"><a class="btn btn-success disabled" href="{{route('order.send',['id'=>$order->id])}}">ارسال کردن</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="center-block text-center">{{ $orders->links() }}</div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
