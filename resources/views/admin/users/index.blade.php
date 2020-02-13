@extends('admin.layout.master')
@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">کاربران</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">نام</th>
                            <th class="text-center">نام خانوادگی</th>
                            <th class="text-center">وضعیت فعال بودن</th>
                            <th class="text-center">تاریخ ثبت نام</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{$loop->index+1}}</td>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->last_name}}</td>
                                @if($user->verified==1)
                                    <td class="text-center"><span class="label label-success">فعال شده</span></td>
                                @else
                                    <td class="text-center"><span class="label label-danger">فعال نشده</span></td>
                                @endif
                                <td class="text-center">{{Facades\Verta::instance($user->created_at)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="center-block text-center">{{ $users->links() }}</div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
