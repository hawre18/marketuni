@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">دسته بندی ها</h3>
                <div class="text-left">
                    <a class="btn btn-app"  href="{{route('categories.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center">کاربر ایجاد کننده</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="text-center">{{$comment->id}}</td>
                                    <td class="text-center">{{$comment->description}}</td>
                                    <td class="text-center">{{$comment->user->name.' '.$comment->user->last_name}}</td>
                                    <td class="text-center">{{$comment->created_at}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{route('comments.edit',$comment->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('comments.delete',$comment->id)}}">حذف</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
    </section>
@endsection
