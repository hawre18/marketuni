@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">اسلایدها</h3>
                <div class="text-left">
                    <a class="btn btn-app"  href="{{route('slides.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('slide_success'))
                    <div class="alert alert-success">
                        <div>{{Session('slide_success')}}</div>
                    </div>
                @elseif(Session::has('slide_error'))
                    <div class="alert alert-danger">
                        <div>{{Session('slide_error')}}</div>
                    </div>
                @elseif(Session::has('one_status'))
                    <div class="alert alert-success">
                        <div>{{Session('one_status')}}</div>
                    </div>
                @elseif(Session::has('zero_status'))
                    <div class="alert alert-danger">
                        <div>{{Session('zero_status')}}</div>
                    </div>
                @elseif(Session::has('status_error'))
                    <div class="alert alert-danger">
                        <div>{{Session('status_error')}}</div>
                    </div>
                @endif
                <div class="table-responsive col-sm-12 col-sm-offset-0">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center" >شناسه</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">وضعیت نشر</th>
                                <th class="text-center">عکس</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slides as $slide)
                                <tr>
                                    <td width="10%" class="text-center">{{ $loop->index + 1 }}</td>
                                    <td width="20%" class="text-center">{{$slide->title}}</td>
                                    @if($slide->status==0)
                                        <td width="15%" class="text-center"><span class="label label-danger">منتشر نشده</span></td>
                                    @else
                                        <td width="15%" class="text-center"><span class="label label-success">منتشر شده</span></td>
                                    @endif
                                    @foreach($slide->photos as $photo)
                                    <td width="20%" class="text-center img-circle"><img class="center-block img-responsive" width="20%" height="8%" src="{{$photo->path}}"></td>
                                    @endforeach
                                    <td width="35%" class="text-center">
                                        <a class="btn btn-warning" href="{{route('slides.edit',$slide->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('slides.delete',$slide->id)}}">حذف</a>
                                        @if($slide->status==0)
                                            <a class="btn btn-success" href="{{route('slides.publish',[$slide->id,$status=1])}}">منتشر کردن</a>
                                        @else
                                            <a class="btn btn-warning" href="{{route('slides.publish',[$slide->id,$status=0])}}">منقضی </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.table-responsive -->
                    <div class="center-block text-center">{{ $slides->links() }}</div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
