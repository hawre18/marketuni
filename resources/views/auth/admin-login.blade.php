@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="header text-center"><h3>{{ __('ورود ادمین') }}</h3></div>
        </br>
        <hr>
        <div class="col-md-8 col-md-offset-2">
                    <div class="card-body center-block" style="border: #0f3e68 solid; padding-top: 5%; padding-left: 5%; padding-right: 5%; background-color: #ffffff;">
                        @if (session('changed_password'))
                            <div class="alert alert-success pull-right" role="alert">
                                {{ session('changed_password') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="control-label">{{ __('آدرس ایمیل') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">{{ __('رمزعبور') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('مرا به خاطر بسپار') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ورود') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                        {{ __('رمز عبور خود را فراموش کرده اید؟') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
    </div>
@endsection
