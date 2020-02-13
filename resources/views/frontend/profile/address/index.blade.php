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
                @if(Session::has('address_success'))
                    <div class="alert alert-success">
                        <div>{{Session('address_success')}}</div>
                    </div>
                @elseif(Session::has('address_warning'))
                    <div class="alert alert-warning">
                        <div>{{Session('address_warning')}}</div>
                    </div>
                @endif
                <div class="box box-info">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th class="text-center">شناسه</th>
                                    <th class="text-center">آدرس</th>
                                    <th class="text-center">شرکت</th>
                                    <th class="text-center">استان</th>
                                    <th class="text-center">شهر</th>
                                    <th class="text-center">کدپستی</th>
                                    <th class="text-center">تلفن</th>
                                    <th class="text-center">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($addresses as $address)
                                    <tr>
                                        <td class="text-center">{{$loop->index+1}}</td>
                                        <td class="text-center">{{$address->address}}</td>
                                        <td class="text-center">{{$address->company}}</td>
                                        <td class="text-center">{{$address->province->name}}</td>
                                        <td class="text-center">{{$address->city->name}}</td>
                                        <td class="text-center">{{$address->post_code}}</td>
                                        <td class="text-center">{{$address->phone}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning" href="{{route('address.edit', $address->id)}}">ویرایش</a>
                                            <a type="submit" class="btn btn-danger" href="{{route('address.delete', $address->id)}}">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <div class="center-block text-center">{{ $addresses->links() }}</div>
                    </div>
                    <div>
                        <a href="{{route('address.create')}}" class="btn btn-primary col-md-12 center-block">ایجاد آدرس جدید</a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
    </div>
@endsection
