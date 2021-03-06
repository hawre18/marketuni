@extends('frontend.layout.master')

@section('content')
    <div class="row center-block">
        @if(Session::has('verify_email'))
            <div class="alert alert-success">
                <div>{{session('verify_email')}}</div>
            </div>
    @endif
    <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
            <h1 class="title">ثبت نام حساب کاربری</h1>
            <p>اگر قبلا حساب کاربریتان را ایجاد کرد اید جهت ورود به <a href="{{route('login')}}">صفحه لاگین</a> مراجعه کنید.</p>
            <form class="form-horizontal" method="post" action="{{ url('/register') }}">
                {{ csrf_field() }}
                <fieldset id="account">
                    <legend>اطلاعات شخصی شما</legend>
                    <div class="form-group required">
                        <label for="input-firstname" class="col-sm-2 control-label">نام</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-firstname" placeholder="نام" name="name">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-lastname" class="col-sm-2 control-label">نام خانوادگی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-lastname" placeholder="نام خانوادگی" name="lastname">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-nationalcode" class="col-sm-2 control-label">شماره ملی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-nationalcode" placeholder="شماره ملی" name="national_code">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-gender" class="col-sm-2 control-label">جنسیت</label>
                        <input type="radio" name="gender" value="0"><span>مرد</span></br>
                        <input type="radio" name="gender" value="1"><span>زن</span>
                    </div>
                    <div class="form-group required">
                        <label for="input-email" class="col-sm-2 control-label">آدرس ایمیل</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="input-email" placeholder="آدرس ایمیل" value="" name="email">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-telephone" class="col-sm-2 control-label">شماره تلفن</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="input-telephone" placeholder="شماره تلفن" value="" name="phone">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>رمز عبور شما</legend>
                    <div class="form-group required">
                        <label for="input-password" class="col-sm-2 control-label">رمز عبور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-password" placeholder="رمز عبور" value="" name="password">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-confirm" class="col-sm-2 control-label">تکرار رمز عبور</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-confirm" placeholder="تکرار رمز عبور" value="" name="confirm">
                        </div>
                    </div>
                </fieldset>
                <div class="buttons">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">
                            ثبت نام
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--Middle Part End -->
    </div>
@endsection
