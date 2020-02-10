@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">کامنت ها</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('comment_success'))
                    <div class="alert alert-success">
                        <div>{{session('comment_success')}}</div>
                    </div>
                @elseif(Session::has('comment_error'))
                    <div class="alert alert-danger">
                        <div>{{session('comment_error')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center" >شناسه</th>
                                <th class="text-center" >توضیحات</th>
                                <th class="text-center" >کاربر ایجاد کننده</th>
                                <th class="text-center" >تاریخ ایجاد</th>
                                <th class="text-center" >محصول</th>
                                <th class="text-center" >وضعیت نشر</th>
                                <th class="text-center" >عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="text-center" ><a href="{{ route('comments.show', $comment->id)}}">{{ $loop->index + 1 }}</a></td>
                                    <td class="text-center" ><a href="{{ route('comments.show', $comment->id)}}">{{mb_substr($comment->description, 0, 15).' ...' }}</a></td>
                                    <td class="text-center" >{{$comment->user['name'].' '.$comment->user['last_name']}}</td>
                                    <td class="text-center" >{{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}</td>
                                    <td class="text-center" >{{$comment->product->title. ' '. 'با کد'.$comment->product->sku}}</td>
                                    @if($comment->status==0)
                                        <td class="center-block label label-danger">تایید نشده</td>
                                    @else
                                    <td class="center-block label label-success" >تایید شده</td>
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
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                </div>
                <!-- /.table-responsive -->
                    <div class="center-block text-center">{{ $comments->links() }}</div>
            </div>
            <!-- /.box-body -->
    </section>
@endsection
