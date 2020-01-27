@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">کامنت ها</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                        <table class="table no-margin">
                                    <lable for="description">متن نظر: </lable></br>
                                    <textarea id="description">{{$comment->description}}</textarea></br>
                                    <lable>کاربر: {{$comment->user->name.' '.$comment->user->last_name}}</lable></br>
                                    <lable>تاریخ ایجاد: {{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</lable></br>
                                    <lable>عنوان محصول: {{$comment->product->title. ' '. 'با کد'.$comment->product->sku}}</lable></br>
                                    @if($comment->status==0)
                                    <lable>وضعیت: تایید نشده</lable>
                                    @else
                                     <lable>وضعیت: تایید شده</lable>
                                    @endif
                                    <td class="text-center ">
                                    @if($comment->status==0)
                                                {!! Form::open(['method'=>'POST','route'=>['comments.action',$comment->id]]) !!}
                                                <div class="form-group">
                                                    {!! Form::hidden('action','approved') !!}
                                                    {!! Form::submit('تایید',['class'=>'btn btn-success']) !!}
                                                    <a class="btn btn-danger" href="{{route('comments.delete',$comment->id)}}">حذف</a>
                                                </div>
                                            {!! Form::close() !!}
                                    @else
                                            <div>
                                                {!! Form::open(['method'=>'POST','route'=>['comments.action',$comment->id]]) !!}
                                                <div class="form-group">
                                                    {!! Form::hidden('action','rejected') !!}
                                                    {!! Form::submit('عدم تایید',['class'=>'btn btn-danger']) !!}
                                                    <a class="btn btn-danger" href="{{route('comments.delete',$comment->id)}}">حذف</a>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                    @endif
                                    </td>
                        </table>
                </div>
            </div>
        </div>
    </section>
@endsection
