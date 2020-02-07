
@extends('frontend.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <p><strong><h3>بازیابی رمز عبور</h3></strong></p></br>
                <div class="row">
                    @if (session('send_email'))
                        <div class="alert alert-success" role="alert">
                            {{ session('send_email') }}
                        </div>
                    @elseif (session('filed_send'))
                         <div class="alert alert-warning" role="alert">
                             {{ session('filed_send') }}
                         </div>
                    @endif
                    <div class="col-sm-12">
                        <form method="POST" action="{{ route('admin.password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="input-email">آدرس ایمیل</label>
                                <input type="text" name="email" @error('email') is-invalid @enderror value="{{ old('email') }}" required autocomplete="email" placeholder="آدرس ایمیل" id="input-email" class="form-control" />
                                <button type="submit" class="btn btn-success">
                                    {{ __('درخواست رمز جدید') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
