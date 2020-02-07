@extends('frontend.layout.master')

@section('content')
<div class="container">
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h1 class="title">حساب کاربری</h1>
            <div class="row">
                <div class="col-sm-6">
                    <p><strong>ثبت نام حساب کاربری</strong></p>
                    <p>با ایجاد حساب کاربری میتوانید سریعتر خرید کرده، از وضعیت خرید خود آگاه شده و تاریخچه ی سفارشات خود را مشاهده کنید.</p>
                    <a href="{{route('register')}}" class="btn btn-success">ثبت نام</a>
                </div>
                @if (session('changed_password'))
                    <div class="alert alert-success pull-right" role="alert">
                        {{ session('changed_password') }}
                    </div>
                @endif
                <div class="col-sm-6">
                    <p><strong>قبلا ثبت نام کرده ام</strong></p>
                    <form method="post" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label" for="input-email">آدرس ایمیل</label>
                            <input type="text" name="email" @error('email') is-invalid @enderror value="{{ old('email') }}" required autocomplete="email" placeholder="آدرس ایمیل" id="input-email" class="form-control" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <label class="label-danger" style="color: #ffffff;">نام کاربری یا کلمه عبور اشتباه است</label>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-password">رمز عبور</label>
                            <input type="password" name="password"  @error('password') is-invalid @enderror required autocomplete="current-password" placeholder="رمز عبور" id="input-password" class="form-control" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <label class="label-danger" style="color: #ffffff;">نام کاربری یا کلمه عبور اشتباه است</label>
                            </span>
                            @enderror
                            <br />
                            <input type="submit" value="ورود" class="btn btn-success" />
                            <a href="{{route('google.login')}}" class="btn btn-success">ورود با حساب کاربری گوگل</a>
                            <a href="{{route('password.request')}}">رمز عبور خود را فراموش کردم</a>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
