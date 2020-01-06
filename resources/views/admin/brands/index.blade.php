@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl;">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">برندها</h3>
                <div class="text-left">
                    <a class="btn btn-app" href="{{route('brands.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('brands'))
                    <div class="alert alert-success">
                        <div>{{session('brands')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">عنوان</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td class="text-center">{{$brand->id}}</td>
                                <td class="text-center">{{$brand->title}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('brands.edit', $brand->id)}}">ویرایش</a>
                                    <a type="submit" class="btn btn-danger" href="{{route('brands.delete', $brand->id)}}">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection
