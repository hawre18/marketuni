@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl;">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">شهرها</h3>
                <div class="text-left">
                    <a class="btn btn-app" href="{{route('cities.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('city_success'))
                    <div class="alert alert-success">
                        <div>{{session('city_success')}}</div>
                    </div>
                    @elseif(Session::has('city_error'))
                        <div class="alert alert-danger">
                            <div>{{session('city_error')}}</div>
                        </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">شهر</th>
                            <th class="text-center">استان</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td class="text-center">{{$loop->index + 1 }}</td>
                                <td class="text-center">{{$city->name}}</td>
                                <td class="text-center">{{$city->province['name']}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('cities.edit', $city->id)}}">ویرایش</a>
                                    <a type="submit" class="btn btn-danger" href="{{route('cities.delete', $city->id)}}">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="center-block text-center">{{ $cities->links() }}</div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection
