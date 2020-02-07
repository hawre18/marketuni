@extends('frontend.layout.master')

@section('content')
    <section class="content" id="app">
        <div class="box box-info">
            <div class="header text-center">
                <h3>ویرایش آدرس</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="/addresses/update/{{$address->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="company">شرکت</label>
                                <input type="text" name="company" class="form-control" value="{{$address->company}}" placeholder="نام شرکت را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="address">آدرس</label>
                                <input type="text" name="address" class="form-control" value="{{$address->address}}" placeholder="آدرس را وارد کنید...">
                            </div>
                           <select-city-component></select-city-component>
                            <div class="form-group">
                                <label for="post_code">کدپستی</label>
                                <input type="text" name="post_code" class="form-control" value="{{$address->post_code}}" placeholder="کدپستی را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="phone">تلفن</label>
                                <input type="text" name="phone" class="form-control" value="{{$address->phone}}" placeholder="شماره همراه را وارد کنید...">
                            </div>

                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section('script-vuejs')
    <script src="{{asset('/admin/js/app.js')}}"></script>
@endsection
