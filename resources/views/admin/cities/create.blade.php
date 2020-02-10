@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد aiv جدید</h3>
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
                        <form id="myForm" method="post" action="/admins/cities">
                            @csrf
                            <div class="form-group">
                                <label for="name">شهر</label>
                                <input type="text" name="name" value="{{old('title')}}" class="form-control" placeholder="نام شهر را وارد کنید...">
                            </div>
                            <div class="form-group">
                                <label for="province">استان</label>
                                <select name="province_id" class="form-control" >
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}")>{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

