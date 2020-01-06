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
                @if(Session::has('slides'))
                    <div class="alert alert-danger">
                        <div>{{Session('slides')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">وضعیت نشر</th>
                                <th class="text-center">عکس</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slides as $slide)
                                <tr>
                                    <td width="20%" class="text-center">{{$slide->id}}</td>
                                    <td width="20%" class="text-center">{{$slide->title}}</td>
                                    @if($slide->status==0)
                                        <td width="20%" class="text-center">منتشر نشده</td>
                                    @else
                                        <td width="20%" class="text-center">منتشر شده</td>
                                    @endif
                                    @foreach($slide->photos as $photo)
                                    <td width="20%" class="text-center img-circle"><img class="center-block img-responsive" width="20%" height="8%" src="{{$photo->path}}"></td>
                                    @endforeach
                                    <td width="20%" class="text-center">
                                        <a class="btn btn-warning" href="{{route('slides.edit',$slide->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('slides.delete',$slide->id)}}">حذف</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
