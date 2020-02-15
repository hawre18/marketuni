@extends('frontend.layout.master')
@section('content')
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="#">تماس با ما</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    <h1 class="title">تماس با ما</h1>
                    <h3 class="subtitle">محل ما</h3>
                    <div class="row">
                        <div class="col-sm-3"><img src="/image/saqqez.jpg" alt="فروشگاه ساکا مارکت" title="فروشگاه ساکا مارکت" class="img-thumbnail" /></div>
                        <div class="col-sm-3"><strong>فروشگاه ساکا مارکت</strong><br />
                            <address>
                                میدان استقلال،<br />
                                خیابان جمهوری،<br />
                                ساکا مارکت،<br />
                            </address>
                        </div>
                        <div class="col-sm-3"><strong>شماره تلفن</strong><br>
                            09184185360<br />
                        </div>
                        <div class="col-sm-3"> <strong>ساعات کار</strong><br />
                            خدمات مشتریان 24x7<br />
                            <br />
                            <strong>دیدگاه ها</strong><br />
                            در اینجا توضیحات دلخواه خود را قرار دهید. </div>
                    </div>
                    <form class="form-horizontal">
                        <fieldset>
                            <h3 class="subtitle">با ما ارتباط برقرار کنید</h3>
                            <div class="form-group required">
                                <label class="col-md-2 col-sm-3 control-label" for="input-name">نام شما</label>
                                <div class="col-md-10 col-sm-9">
                                    <input type="text" name="name" value="" id="input-name" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 col-sm-3 control-label" for="input-email">آدرس ایمیل</label>
                                <div class="col-md-10 col-sm-9">
                                    <input type="text" name="email" value="" id="input-email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">پرسش</label>
                                <div class="col-md-10 col-sm-9">
                                    <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">
                                <input class="btn btn-primary" type="submit" value="ارسال" />
                            </div>
                        </div>
                    </form>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
</div>
@endsection
