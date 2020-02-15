@extends('frontend.layout.master')
@section('content')
    <div class="row center-block">
        <aside id="column-right" class="col-sm-3 hidden-xs">
            <h3 class="subtitle">حساب کاربری</h3>
            <div class="list-group">
                <ul class="list-item">
                    <li><a href="{{route('addresses.index')}}">لیست آدرس ها</a></li>
                    <li><a href="{{route('favorites.index')}}">لیست علاقه مندی</a></li>
                    <li><a href="{{route('orders.userindex')}}">تاریخچه سفارشات</a></li>
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
                                    <th class="text-center">نام محصول</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($favorites as $favorite)
                                    <tr>
                                        <td class="text-center"><a href="{{route('products.single',['id'=>$favorite->product->id])}}">{{$loop->index+1}}</a></td>
                                        <td class="text-center"><a href="{{route('products.single',['id'=>$favorite->product->id])}}">{{$favorite->product->title}}</a></td>
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
