@extends('frontend.layout.master')

@section('content')
    <div class="row center-block" id="app">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
            <h1 class="title">ایجاد آدرس</h1>
            <form class="form-horizontal" method="post" action="{{url('ste-address')}}">
                @csrf
                <fieldset id="address">
                    <legend>آدرس</legend>
                    <div class="form-group">
                        <label for="input-company" class="col-sm-2 control-label">شرکت</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-company" placeholder="شرکت" value="" name="company">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-address-1" class="col-sm-2 control-label">آدرس</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-1" placeholder="آدرس" value="" name="address">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-postcode" class="col-sm-2 control-label">کد پستی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-postcode" placeholder="کد پستی" value="" name="post_code">
                        </div>
                    </div>
                    <select-city-component></select-city-component>
                    <div class="form-group required">
                        <label for="input-telephone" class="col-sm-2 control-label">شماره تلفن</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="input-telephone" placeholder="شماره تلفن" value="" name="phone">
                        </div>
                    </div>
                </fieldset>
                <div class="buttons">
                    <div class="pull-right">
                        <input type="hidden" name="_method" value="GET" >
                        <input type="submit" class="btn btn-primary" value="ثبت">
                    </div>
                </div>
            </form>
        </div>
        <!--Middle Part End -->
    </div>
@endsection
@section('script-vuejs')
    <script src="{{asset('/admin/js/app.js')}}"></script>
@endsection
