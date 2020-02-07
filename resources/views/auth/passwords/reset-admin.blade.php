@extends('frontend.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <p><strong><h3>بازیابی رمز عبور</h3></strong></p></br>
                <div class="row">
                    <div class="col-sm-12">
                        @if (session('error_changed'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('error_changed') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.password.request') }}" style="direction: rtl;">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                             <div class="form-group">
                                 <label class="control-label" for="email">آدرس ایمیل</label>
                                 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            </div>
                             <div class="form-group">
                                 <label class="control-label" for="password">رمز عبور جدید</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                             <div class="form-group">
                                 <label class="control-label" for="password-confirm">تکرار رمز عبور</label>
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="form-group row mb-0">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('بازیابی رمز عبور') }}
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
