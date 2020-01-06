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
                        <form method="post" action="\admins\products">
                            @csrf
                            <div class="form-group">
                                <label for="title">نام محصول</label>
                                <input type="text" name="title" class="form-control" placeholder="نام محصول">
                            </div>
                            <div class="form-group">
                                <label for="slug">نام مستعار محصول</label>
                                <input type="text" name="slug" class="form-control" placeholder="نام مستعار محصول">
                            </div>
                            <attribute-component :brands="{{$brands}}"></attribute-component>
                            <div>
                                <label >وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" ><span>منتشر نشده</span>
                                    <input type="radio" name="status" value="1" ><span>منتشر شده</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label >قیمت</label>
                                <input type="number" name="price" class="form-control" placeholder="قیمت محصول">
                            </div>
                            <div class="form-group">
                                <label >قیمت ویژه</label>
                                <input type="number" name="discount_price" class="form-control" placeholder="قیمت ویژه محصول">
                            </div>
                            <div class="form-group">
                                <label >توضیحات کوتاه</label>
                                <textarea id="ShortDescription" name="short_description" class="form-control" ></textarea>
                            </div>
                            <div class="form-group">
                                <label >توضیحات اصلی</label>
                                <textarea  id="longDescription" name="long_description" class="form-control" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="product-photo">
                                <div id="photo" class="dropzone" ></div>
                                <div class="=row">
                                </div>
                            </div>
                            <button type="submit" onclick="productGallery()" class="btn btn-success pull-left">ذخیره</button>
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
    <script type="text/javascript" src="{{asset('/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        Dropzone.autoDiscover=false;
        var photosGallery=[]
        var drop=new Dropzone('#photo',{
            addRemoveLinks:true,
            url:"{{route('photos.upload')}}",
            sending:function (file,xhr,formData) {
            formData.append("_token","{{csrf_token()}}")
            },
            success: function (file,response) {
                photosGallery.push(response.photo_id)
            }
        });
        productGallery=function () {
                document.getElementById('product-photo').value = photosGallery
        }
        CKEDITOR.replace('ShortDescription',{
        customConfig:'config.js',
        toolbar:'simple',
        language:'fa',
        removePlugins:'cloudservices, easyimage'
        });
        CKEDITOR.replace('longDescription',{
            customConfig:'config.js',
            toolbar:'simple',
            language:'fa',
            removePlugins:'cloudservices, easyimage'
        })
    </script>
@endsection
