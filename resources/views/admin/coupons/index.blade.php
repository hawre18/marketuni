@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">کوپن ها</h3>
                <div class="text-left">
                    <a class="btn btn-app"  href="{{route('coupons.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('coupon_success'))
                    <div class="alert alert-success">
                        <div>{{Session('coupon_success')}}</div>
                    </div>
                    @elseif(Session::has('coupon_error'))
                        <div class="alert alert-danger">
                            <div>{{Session('coupon_error')}}</div>
                        </div>
                    @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">عنوان تخفیف</th>
                                <th class="text-center">کد تخفیف</th>
                                <th class="text-center">مقدار تخفیف</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{$coupon->title}}</td>
                                    <td class="text-center">{{$coupon->code}}</td>
                                    <td class="text-center">{{$coupon->price}}</td>
                                    @if($coupon->status==0)
                                        <td class="text-center">غیر فعال</td>
                                    @else
                                        <td class="text-center">فعال</td>
                                @endif
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{route('coupons.edit',$coupon->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('coupons.delete',$coupon->id)}}">حذف</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
