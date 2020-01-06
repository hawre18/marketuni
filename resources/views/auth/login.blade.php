@extends('frontend.layout.master')

@section('content')
<div class="container">
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h1 class="title">حساب کاربری ورود</h1>
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="subtitle">مشتری جدید</h2>
                    <p><strong>ثبت نام حساب کاربری</strong></p>
                    <p>با ایجاد حساب کاربری میتوانید سریعتر خرید کرده، از وضعیت خرید خود آگاه شده و تاریخچه ی سفارشات خود را مشاهده کنید.</p>
                    <a href="register.html" class="btn btn-primary">ادامه</a> </div>
                <div class="col-sm-6">
                    <h2 class="subtitle">مشتری قبلی</h2>
                    <p><strong>من از قبل مشتری شما هستم</strong></p>
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="input-email">آدرس ایمیل</label>
                            <input type="text" name="email" @error('email') is-invalid @enderror value="{{ old('email') }}" required autocomplete="email" autofocusvalue="" placeholder="آدرس ایمیل" id="input-email" class="form-control" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-password">رمز عبور</label>
                            <input type="password" name="password"  @error('password') is-invalid @enderror required autocomplete="current-password" placeholder="رمز عبور" id="input-password" class="form-control" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br />
                            <input type="submit" value="ورود" class="btn btn-primary" />
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>>
@endsection