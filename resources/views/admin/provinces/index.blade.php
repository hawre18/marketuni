@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl;">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">استان ها</h3>
                <div class="text-left">
                    <a class="btn btn-app" href="{{route('province.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('province_success'))
                    <div class="alert alert-success">
                        <div>{{session('province_success')}}</div>
                    </div>
                    @elseif(Session::has('province_error'))
                        <div class="alert alert-danger">
                            <div>{{session('province_error')}}</div>
                        </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">استان</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($provinces as $province)
                            <tr>
                                <td class="text-center">{{$loop->index + 1 }}</td>
                                <td class="text-center">{{$province->name}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('province.edit', $province->id)}}">ویرایش</a>
                                    <a type="submit" class="btn btn-danger" href="{{route('province.delete', $province->id)}}">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="center-block text-center">{{ $provinces->links() }}</div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection
