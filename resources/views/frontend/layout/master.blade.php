<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ساکا مارکت</title>
    <meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
    <!-- CSS Part Start-->
    <link rel="stylesheet" type="text/css" href="/js/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/js/bootstrap/css/bootstrap-rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="/css/owl.transitions.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="/css/stylesheet-rtl.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive-rtl.css" />
    <link rel="stylesheet" type="text/css" href="/css/stylesheet-skin2.css" />
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- CSS Part End-->
</head>
<body>
<div class="wrapper-wide" style="background-color: #edf7fa;">
    <div id="header" >
        <!-- Top Bar Start-->
        <nav id="top" class="htop" style="background-color: #edf7fa;">
            <div class="container" style="background-color: #edf7fa;">
                <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
                    <div class="pull-left flip left-top">
                        <div class="links" style="border: none;">
                            <ul>
                                <li class="mobile" style="background-color: #edf7fa; border: none;"><i class="fa fa-phone"></i>09184185360</li>
                                <li class="email" style="background-color: #edf7fa;border: none;"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i>hawremi18@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="top-links" class="nav pull-right flip" style="background-color: #edf7fa;border: none;">
                        @if(Auth::check())
                        <ul>
                            <li style="border: none;"><a href="{{route('logout')}}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a></li>
                            <li style="border: none;"><a href="{{route('user.profile')}}"><i class="fa fa-user"></i></a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                            @csrf
                        </form>
                        @else
                        <ul>
                            <li style="border: none;"><a href="{{route('login')}}"><i class="fa fa-sign-in"></i></a></li>
                            <li style="border: none;"><a href="{{route('register')}}"><i class="fa fa-user-plus"></i></a></li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <!-- Top Bar End-->
        <!-- Header Start-->
        <header class="header-row" style="background-color: #0f4c75;">
            <div class="container">
                <div class="table-container">
                    <!-- Logo Start -->
                    <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
                        <div id="logo">
                            <a href="index.html">
                                <img class="img-responsive" src="/image/logo.png" title="MarketShop" alt="MarketShop" />
                            </a>
                        </div>
                    </div>
                    <!-- Logo End -->
                    <!-- Mini Cart Start-->
                    <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div id="cart">
                            <button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle">
                                <span class="cart-icon pull-left flip"></span>
                                <span id="cart-total">{{Session::has('cart') ? Session::get('cart')->totalQty.'آیتم':''}}{{Session::has('cart') ? Session::get('cart')->totalPrice.'تومان':''}}</span>
                            </button>
                            <ul class="dropdown-menu">
                                @if(Session::has('cart'))
                                <li>
                                    <table class="table">
                                        @foreach(Session::get('cart')->items as $product)
                                        <tbody>
                                        <tr>
                                            <td class="text-center"><img class="img-thumbnail" src="{{$product['item']->photos[0]->path}}"></td>
                                            <td class="text-left">{{$product['item']->title}}</td>
                                            <td class="text-right">x {{$product['qty']}}</td>
                                            <td class="text-right">{{$product['price']}} تومان</td>
                                            <td class="text-center">
                                                 <button class="btn btn-danger btn-xs remove" title="حذف" onclick="event.preventDefault();
                                                       document.getElementById('remove-cart-item_{{$product['item']->id}}').submit();" type="button"><i class="fa fa-times"></i>
                                                 </button></td>
                                            <form id="remove-cart-item_{{$product['item']->id}}" action="{{ route('cart.remove',['id'=>$product['item']->id]) }}" method="post" style="display: none;">
                                                @csrf
                                            </form>
                                        </tr>

                                        </tbody>
                                        @endforeach
                                    </table>
                                </li>
                                <li>
                                    <div>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-right"><strong>جمع کل</strong></td>
                                                <td class="text-right">{{Session::get('cart')->totalPurePrice}} تومان</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>کسر هدیه</strong></td>
                                                <td class="text-right">{{Session::get('cart')->totalDiscountPrice}} تومان</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>قابل پرداخت</strong></td>
                                                <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="checkout"><a href="{{route('cart.get')}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> مشاهده سبد</a>
                                    </div>
                                </li>
                                @else
                                    <p>سبد خرید شما خالی است</p>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- Mini Cart End-->
                    <!-- جستجو Start-->
                    <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner" >
                        <div id="search" class="input-group" >
                            <input id="filter_name" type="text" name="search" value="" placeholder="جستجو" class="form-control input-lg" style="background-color: #ffffff;color: #000000;" />
                            <button type="button" class="button-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <!-- جستجو End-->
                </div>
            </div>
        </header>
        <!-- Header End-->
        <!-- Main آقایانu Start-->
        <nav id="menu" class="navbar" style="background-color: #edf7fa;">
            <div class="navbar-header"> <span class="visible-xs visible-sm"> منو <b></b></span></div>
            <div class="container" style="background-color: #0f4c75;border-radius:5px;">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a class="home_link" title="خانه" href="{{''}}">خانه</a></li>
                        @foreach($categories=App\Category::where('parent_id',null)->get() as $cat)
                            @if( $cat->parent_id == null )
                                <li class="dropdown"><a href="{{route('category.index',['id'=>$cat])}}">{{$cat->name}}</a>
                                    <div class="dropdown-menu">
                                        @if(!$cat->children->isEmpty())
                                            <ul>
                                                @include('frontend.partials.menu',['categories'=>$cat->childrenRecursive, 'level'=>1])
                                            </ul>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main آقایانu End-->
    </div>
    <div class="container center-block" style="margin-top: 3%;">
        <div class="custom-feature-box row" style="background-color: #0f4c75;border-radius:5px;">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="feature-box fbox_1" style="margin-top: 5%;background-color: #0f4c75;">
                    <div class="title"><i class="fa fa-truck"></i>ارسال رایگان<i class="fa fa-truck"></i></div>
                    <p>برای خزید های بالای 150 هزار</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="feature-box fbox_2"style="margin-top: 5%;background-color: #0f4c75;">
                    <div class="title">قبول مرجوع دادن کالا<i class="f"></i></div>
                    <p>بازگشت کالا تا 7 روز بعد از دریافت سفارش</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12" >
                <div class="feature-box fbox_3"style="margin-top: 5%; background-color: #0f4c75;">
                    <div class="title"><i class="fa fa-money"></i>کارت هدیه<i class="fa fa-money"></i></div>
                    <p>با خرید کارت تخفیف آن را به عزیزانتان هدیه دهید</p>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <!-- Feature Box Start-->
    <!-- Feature Box End-->
    <!--Footer Start-->
    <footer id="footer">
        <div class="fpart-first">
            <div class="container">
                <div class="row">
                    <div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h5>درباره مارکت شاپ</h5>
                        <p>قالب HTML فروشگاهی مارکت شاپ. این یک بلاک مدیریت محتواست. شما میتوانید هر نوع محتوای html نوشتاری یا تصویری را در آن قرار دهید.</p>
                    </div>
                    <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <h5>حساب من</h5>
                        @if(Auth::check())
                            <ul>
                                <li><a href="{{route('user.profile')}}">حساب کاربری</a></li>
                                <li><a href="{{route('profile.orders')}}">تاریخچه سفارشات</a></li>
                                <li><a href="#">لیست علاقه مندی</a></li>
                                <li><a href="contact-us.html">تماس با ما</a></li>

                            </ul>
                        @else
                            <ul>
                                <li><a href="{{route('login')}}">ورود به حساب کاربری</a></li>
                                <li><a href="{{route('register')}}">ساخت حساب جدید</a></li>
                                <li><a href="contact-us.html">تماس با ما</a></li>

                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="fpart-second">
            <div class="container">
                <div id="powered" class="clearfix">
                    <div class="powered_text pull-left flip">
                        <p>حق کپی رایت برای فروشگاه ساکا مارکت محفوظ است<i class="fa fa-copyright"></i></p>
                    </div>
                    <div class="social pull-right flip">
                        <a href="#" target="_blank"><i class="fa fa-instagram fa-2x"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-whatsapp fa-2x"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
                    </div>
                </div>
                <div class="bottom-row">
                    <div class="payments_types">
                        <a href="#" ><i class="fa fa-cc-mastercard fa-2x"></i></a>
                        <a href="#" ><i class="fa fa-paypal fa-2x"></i></a>
                        <a href="#" ><i class="fa fa-cc-discover fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="back-top">
            <a data-toggle="tooltip" title="بازگشت به بالا" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a>
        </div>
    </footer>
    <!--Footer End-->

</div>
@yield('script-vuejs')
<!-- JS Part Start-->
<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="/js/jquery.elevateZoom-3.0.8.min.js"></script>
<script type="text/javascript" src="/js/swipebox/lib/ios-orientationchange-fix.js"></script>
<script type="text/javascript" src="/js/swipebox/src/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
@yield('script')
<!-- JS Part End-->
</body>
</html>
