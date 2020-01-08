@extends('admin.layout.master')
@section('content')
    <section class="content" style="direction: rtl">
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
                        <p><strong>آدرس خریدار: </strong>{{$order->user->addresses[0]->province->name . ' '.$order->user->addresses[0]->city->name . ' '.$order->user->addresses[0]->address}}</p>
                        <p><strong>کدپستی خریدار: </strong>{{$order->user->addresses[0]->post_code}}</p>
                        <p><strong>شماره موبایل خریدار: </strong>{{$order->user->phone}}</p>
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
