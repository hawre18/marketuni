@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد اسلاید صفحه اصلی فروشگاه</h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="\admins\slides">
                            @csrf
                            <div class="form-group">
                                <label for="title">عنوان اسلاید</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان اسلاید">
                            </div>
                            <div>
                                <label >وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" ><span>منتشر نشده</span>
                                    <input type="radio" name="status" value="1" ><span>منتشر شده</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="slide-photo">
                                <div id="photo" class="dropzone" ></div>
                                <div class="=row">
                                </div>
                            </div>
                            <button type="submit" onclick="sliderGallery()" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script>
        Dropzone.autoDiscover=false;
        var slidesGallery=[]
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
            document.getElementById('slide-photo').value = slidesGallery
        }
    </script>
@endsection
