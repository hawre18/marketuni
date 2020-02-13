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
                    <h3>پروفایل کاربری</h3>
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
    </div>
@endsection
