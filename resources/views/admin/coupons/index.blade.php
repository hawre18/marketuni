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
                @if(Session::has('coupons'))
                    <div class="alert alert-danger">
                        <div>{{Session('coupons')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th >عنوان تخفیف</th>
                                <th >کد تخفیف</th>
                                <th >مقدار تخفیف</th>
                                <th >وضعیت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td class="text-center">{{$coupon->id}}</td>
                                    <td class="text-center">{{$coupon->title}}</td>
                                    <td class="text-center">{{$coupon->code}}</td>
                                    <td class="text-center">{{$coupon->price}}</td>
                                    @if($coupon->status==0){
                                        <td class="text-center">غیر فعال</td>
                                    }@else{
                                        <td class="text-center">فعال</td>
                                    }
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
