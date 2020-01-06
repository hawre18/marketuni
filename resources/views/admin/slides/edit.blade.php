@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section id="app" class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد برند جدید</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="\admins\slidess\{{$slide->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">عنوان اسلاید</label>
                                <input type="text" name="title" value="{{$slide->title}}" class="form-control" placeholder="نام محصول">
                            </div>
                            <div>
                                <label >وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" @if($slide->status==0) checked @endif ><span>منتشر نشده</span>
                                    <input type="radio" name="status" value="1" @if($slide->status==1) checked @endif><span>منتشر شده</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="slide-photo">
                                <div class="form-control dropzone" id="photo"></div>
                                @foreach($slide->photos as $photo)
                                    <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                        <img class="img-responsive" src="{{$photo->path}}">
                                        <button type="button" class="btn btn-danger" onclick="removeImages({{$photo->id}})">حذف</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" onclick="slideGallery()" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
@section('script-vuejs')
    <script src="{{asset('/admin/js/app.js')}}"></script>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script>
        Dropzone.autoDiscover=false;
        var slidesGallery=[]
        var photo=[].concat({{$slide->photos->pluck('id')}})
        var drop=new Dropzone('#photo',{
            addRemoveLinks:true,
            url:"{{route('photos.upload')}}",
            sending:function (file,xhr,formData) {
                formData.append("_token","{{csrf_token()}}")
            },
            success: function (file,response) {
                slidesGallery.push(response.photo_id)
            }
        });
        sliderGallery=function () {
            document.getElementById('slide-photo').value=slidesGallery.concat(photo)
        }
        removeImages=function (id) {
            var index=photo.indexOf(id)
            photo.splice(index,1);
            document.getElementById('updated_photo_'+id).remove();
        }
    </script>
@endsection
