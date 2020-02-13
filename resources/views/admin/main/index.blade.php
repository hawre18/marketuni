@extends('admin.layout.master')
@section('content')
        <section class="content-header">
            <h1>
                داشبورد
                <small>پنل کاربری ادمین</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>خانه</a></li>
                <li class="active">داشبورد</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$neworders}}</h3>

                            <p>سفارشات جدید</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('orders.new')}}" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{$unpaidorders}}</h3>

                            <p>سفارشات پرداخت نشده</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('orders.unpaid')}}" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$newusers}}</h3>

                            <p>کاربران جدید</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('new.users')}}" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> اطلاعات بیشتر </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endsection
