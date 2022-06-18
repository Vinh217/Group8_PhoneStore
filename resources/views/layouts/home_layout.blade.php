<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Smart Phone</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" value="{{ csrf_token() }}">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"> --}}
    <link rel="icon" href="https://cdn.mobilecity.vn/mobilecity-vn/images/2022/01/w80/mc-logo-15-1.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/material-design-iconic-font.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css') }}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('public/frontend/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/helper.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/custom.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
    <!-- Modernizr js -->
    <script src="{{asset('public/frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    @yield('css')
</head>
<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    {{-- @if (session('msg'))
    <div id="alerthome" class="alert alert-success animate__animated animate__bounceInLeft " style="position:fixed;top:9px;right:20%;z-index:9999;transition:all ease 0.5s">
        <i class="fa fa-check" aria-hidden="true"></i> {{ session('msg') }}
    </div>
    @endif

    @if (session('error'))
    <div id="alerthome" class="alert alert-danger animate__animated animate__bounceInLeft " style="position:fixed;top:9px;right:20%;z-index:9999;transition:all ease 0.5s">
        <i class="fa fa-check" aria-hidden="true"></i> {{ session('error') }}
    </div>
    @endif --}}

    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left">
                                <ul class="phone-wrap">
                                    <li><span>Số điện thoại:</span><a href="#">(+84) 911 185 278</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-9 col-md-8">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <li>
                                        <div class="ht-setting-trigger"><span>Cài đặt</span></div>
                                        <div class="setting ht-setting">
                                            <ul class="ht-setting-list">

                                                {{--<li><a href="login-register.html">My Account</a></li>
                                                <li><a href="{{route('user.checkout')}}">Checkout</a>
                                    </li>
                                    <!-- Authentication Links -->
                                    @if (Route::has('user.login'))
                                    @auth('customer')
                                    <li><a href="{{ route('user-logout')  }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ Auth::guard('customer')->user()->name }}</a>
                                        <form action="{{ route('user-logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                                        --}}

                                        {{-- <li><a href="checkout.html">Checkout</a></li> --}}
                                        <!-- Authentication Links -->
                                        {{-- @if (Route::has('user.login')) --}}
                                        @if(Auth::guard('customer')->check())
                                        {{-- @auth --}}
                                    <li><a href="{{route('user.infocustomer',['id' => Auth::guard('customer')->user()->id])}}">Tài khoản </a></li>
                                    <li><a href="{{route('user.orderByUser')}}">Đơn hàng</a></li>
                                    <li><a href="{{ route('user.signout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
                                        <form action="{{ route('user.signout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                                    </li>
                                    @else
                                    <li><a href="{{ route('user.login')}}">Đăng nhập</a></li>
                                    @if (Route::has('user.register'))
                                    <li><a href="{{route('user.register')}}">Đăng ký</a></li>
                                    @endif
                                    @endif
                                </ul>
                            </div>
                            </li>
                            <!-- Setting Area End Here -->
                            <!-- Begin Language Area -->
                            <li>
                                <span class="language-selector-wrapper">Ngôn ngữ :</span>
                                <div class="ht-language-trigger"><span>Tiếng Việt</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li class="active"><a href="#"><img src="{{asset('public/frontend/images/menu/flag-icon/vietnam.png')}}" alt="">Tiếng Việt</a></li>
                                        <li><a href="#"><img src="{{asset('public/frontend/images/menu/flag-icon/1.jpg')}}" alt="">English</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Language Area End Here -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="{{url('/main-page')}}">
                            <svg version="1.1" x="0px" y="0px" width="175.748px" height="42.52px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52">
                                <ellipse class="ellipse-bg" fill-rule="evenodd" clip-rule="evenodd" fill="#FDD700" cx="170.05" cy="36.341" rx="5.32" ry="5.367"></ellipse>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#333E48" d="M30.514,0.71c-0.034,0.003-0.066,0.008-0.056,0.056
                                C30.263,0.995,29.876,1.181,29.79,1.5c-0.148,0.548,0,1.568,0,2.427v36.459c0.265,0.221,0.506,0.465,0.725,0.734h6.187
                                c0.2-0.25,0.423-0.477,0.669-0.678V1.387C37.124,1.185,36.9,0.959,36.701,0.71H30.514z M117.517,12.731
                                c-0.232-0.189-0.439-0.64-0.781-0.734c-0.754-0.209-2.039,0-3.121,0h-3.176V4.435c-0.232-0.189-0.439-0.639-0.781-0.733
                                c-0.719-0.2-1.969,0-3.01,0h-3.01c-0.238,0.273-0.625,0.431-0.725,0.847c-0.203,0.852,0,2.399,0,3.725
                                c0,1.393,0.045,2.748-0.055,3.725h-6.41c-0.184,0.237-0.629,0.434-0.725,0.791c-0.178,0.654,0,1.813,0,2.765v2.766
                                c0.232,0.188,0.439,0.64,0.779,0.733c0.777,0.216,2.109,0,3.234,0c1.154,0,2.291-0.045,3.176,0.057v21.277
                                c0.232,0.189,0.439,0.639,0.781,0.734c0.719,0.199,1.969,0,3.01,0h3.01c1.008-0.451,0.725-1.889,0.725-3.443
                                c-0.002-6.164-0.047-12.867,0.055-18.625h6.299c0.182-0.236,0.627-0.434,0.725-0.79c0.176-0.653,0-1.813,0-2.765V12.731z
                                M135.851,18.262c0.201-0.746,0-2.029,0-3.104v-3.104c-0.287-0.245-0.434-0.637-0.781-0.733c-0.824-0.229-1.992-0.044-2.898,0
                                c-2.158,0.104-4.506,0.675-5.74,1.411c-0.146-0.362-0.451-0.853-0.893-0.96c-0.693-0.169-1.859,0-2.842,0h-2.842
                                c-0.258,0.319-0.625,0.42-0.725,0.79c-0.223,0.82,0,2.338,0,3.443c0,8.109-0.002,16.635,0,24.381
                                c0.232,0.189,0.439,0.639,0.779,0.734c0.707,0.195,1.93,0,2.955,0h3.01c0.918-0.463,0.725-1.352,0.725-2.822V36.21
                                c-0.002-3.902-0.242-9.117,0-12.473c0.297-4.142,3.836-4.877,8.527-4.686C135.312,18.816,135.757,18.606,135.851,18.262z
                                M14.796,11.376c-5.472,0.262-9.443,3.178-11.76,7.056c-2.435,4.075-2.789,10.62-0.501,15.126c2.043,4.023,5.91,7.115,10.701,7.9
                                c6.051,0.992,10.992-1.219,14.324-3.838c-0.687-1.1-1.419-2.664-2.118-3.951c-0.398-0.734-0.652-1.486-1.616-1.467
                                c-1.942,0.787-4.272,2.262-7.134,2.145c-3.791-0.154-6.659-1.842-7.524-4.91h19.452c0.146-2.793,0.22-5.338-0.279-7.563
                                C26.961,15.728,22.503,11.008,14.796,11.376z M9,23.284c0.921-2.508,3.033-4.514,6.298-4.627c3.083-0.107,4.994,1.976,5.685,4.627
                                C17.119,23.38,12.865,23.38,9,23.284z M52.418,11.376c-5.551,0.266-9.395,3.142-11.76,7.056
                                c-2.476,4.097-2.829,10.493-0.557,15.069c1.997,4.021,5.895,7.156,10.646,7.957c6.068,1.023,11-1.227,14.379-3.781
                                c-0.479-0.896-0.875-1.742-1.393-2.709c-0.312-0.582-1.024-2.234-1.561-2.539c-0.912-0.52-1.428,0.135-2.23,0.508
                                c-0.564,0.262-1.223,0.523-1.672,0.676c-4.768,1.621-10.372,0.268-11.537-4.176h19.451c0.668-5.443-0.419-9.953-2.73-13.037
                                C61.197,13.388,57.774,11.12,52.418,11.376z M46.622,23.343c0.708-2.553,3.161-4.578,6.242-4.686
                                c3.08-0.107,5.08,1.953,5.686,4.686H46.622z M160.371,15.497c-2.455-2.453-6.143-4.291-10.869-4.064
                                c-2.268,0.109-4.297,0.65-6.02,1.524c-1.719,0.873-3.092,1.957-4.234,3.217c-2.287,2.519-4.164,6.004-3.902,11.007
                                c0.248,4.736,1.979,7.813,4.627,10.326c2.568,2.439,6.148,4.254,10.867,4.064c4.457-0.18,7.889-2.115,10.199-4.684
                                c2.469-2.746,4.012-5.971,3.959-11.063C164.949,21.134,162.732,17.854,160.371,15.497z M149.558,33.952
                                c-3.246-0.221-5.701-2.615-6.41-5.418c-0.174-0.689-0.26-1.25-0.4-2.166c-0.035-0.234,0.072-0.523-0.045-0.77
                                c0.682-3.698,2.912-6.257,6.799-6.547c2.543-0.189,4.258,0.735,5.52,1.863c1.322,1.182,2.303,2.715,2.451,4.967
                                C157.789,30.669,154.185,34.267,149.558,33.952z M88.812,29.55c-1.232,2.363-2.9,4.307-6.13,4.402
                                c-4.729,0.141-8.038-3.16-8.025-7.563c0.004-1.412,0.324-2.65,0.947-3.726c1.197-2.061,3.507-3.688,6.633-3.612
                                c3.222,0.079,4.966,1.708,6.632,3.668c1.328-1.059,2.529-1.948,3.9-2.99c0.416-0.315,1.076-0.688,1.227-1.072
                                c0.404-1.031-0.365-1.502-0.891-2.088c-2.543-2.835-6.66-5.377-11.704-5.137c-6.02,0.288-10.218,3.697-12.484,7.846
                                c-1.293,2.365-1.951,5.158-1.729,8.408c0.209,3.053,1.191,5.496,2.619,7.508c2.842,4.004,7.385,6.973,13.656,6.377
                                c5.976-0.568,9.574-3.936,11.816-8.354c-0.141-0.271-0.221-0.604-0.336-0.902C92.929,31.364,90.843,30.485,88.812,29.55z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="{{route('searchProduct')}}" class="hm-searchbox" method="post">
                        @csrf
                        {{-- <select class="nice-select select-search-category">
                            <option value="0">All</option>
                            <option value="10">Laptops</option>
                        </select> --}}
                        <input type="text" required placeholder="Nhập từ khóa để tìm kiếm ..." name="keyword" value="{{ old('keyword') }}" oninvalid="this.setCustomValidity('Chưa nhập từ khóa để tìm kiếm')" oninput="this.setCustomValidity('')">
                        <button class=" li-btn v-li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            {{-- <li class="hm-wishlist">
                                <a href="wishlist.html">
                                    <span class="cart-item-count wishlist-item-count">0</span>
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </li> --}}
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    {{-- {{ trim(Cart::priceTotal(0)) }}₫ --}}
                                    <span class="item-text font-weight-bold" style="font-family: Roboto,Helvetica,Arial,sans-serif">
                                        Giỏ hàng
                                        <span class="cart-item-count">{{Cart::count()}}</span>
                                    </span>
                                </div>
                                <span></span>
                                <div class="minicart">
                                    <ul class="minicart-product-list">
                                        @foreach (Cart::content() as $row)
                                        @if($loop->index < 2)
                                        <li>
                                            <a href="single-product.html" class="minicart-product-image">
                                                <img src="{{ asset('public/backend/uploads/product-images/'.$row->options->photo) }}" height="50" width="auto">
                                            </a>
                                            <div class="minicart-product-details">
                                                <h6><a href="#">{{$row->name}} - {{ $row->options->color }}</a></h6>
                                                <span>{{number_format($row->price)}}₫ x {{ $row->qty }}</span>
                                            </div>
                                            <a href="{{ route('user.cartRemove' ,['id'=> $row->rowId]) }}">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </li>
                                        @else
                                            <li style="text-align: center; justify-content:center;"><span class="font-weight-bold">............ Còn nữa ............</span></li>
                                            @break
                                        @endif
                                        @endforeach
                                    </ul>
                                    <p class="minicart-total">Tổng tiền: <span>{{Cart::priceTotal(0)}}₫</span></p>
                                    <div class="minicart-button">
                                        <a href="{{ route('user.fullcart') }}" class="li-button li-button-fullwidth li-button-dark">
                                            <span style="font-family: Roboto,Helvetica,Arial,sans-serif">Xem giỏ hàng</span>
                                        </a>
                                        {{-- <form action="/create-checkout-session" method="POST">
                                                    <button type="submit">Checkout</button>
                                                  </form> --}}
                                        <a href="{{ route('user.checkout') }}" class="li-button li-button-fullwidth">
                                            <span style="font-family: Roboto,Helvetica,Arial,sans-serif">Thanh toán</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block v-header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a class="font-weight-bold" href="{{ url('main-page') }}">Trang Chủ</a>
                                <li class="dropdown-holder custom-dropdown "><a class="font-weight-bold" href="#">Danh mục</a>
                                    <ul class="hb-dropdown">
                                        @foreach ($supplier as $s)
                                        <li><a href="{{ url('productBySupplier/'.$s->MaNSX) }}">{{ $s->TenNSX }}</a>
                                            @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ url('about-us') }}" class="font-weight-bold">Giới thiệu</a></li>
                                <li><a href="{{ url('contact') }}" class="font-weight-bold">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->

    {{-- Main Content --}}
    @yield('content')
    {{-- End Main Content --}}

    <!-- Begin Footer Area -->
    <div class="footer">
        <!-- Begin Footer Static Top Area -->
        <div class="footer-static-top">
            <div class="container">
                <!-- Begin Footer Shipping Area -->
                <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                    <div class="row">
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/1.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Miễn phí vận chuyển</h2>
                                    <p>Miễn phí trả hàng. Kiểm tra hóa đơn để xem ngày giao hàng</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/2.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>Thanh toán an toàn</h2>
                                    {{-- <p>Pay with the world's most popular and secure payment methods.</p> --}}
                                    <p>Thanh toán bằng phương thức an toàn và bảo mật nhất</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/3.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    {{-- <h2>Shop with Confidence</h2>
                                    <p>Our Buyer Protection covers your purchasefrom click to delivery.</p> --}}
                                    <h2>Mua bán đảm bảo</h2>
                                    <p>Hệ thông bảo vệ người mua quản lý thanh toán của bạn từ click đến việc vận chuyển</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('public/frontend/images/shipping-icon/4.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    {{-- <h2>24/7 Help Center</h2>
                                    <p>Have a question? Call a Specialist or chat online.</p> --}}
                                    <h2>Trung tâm hỗ trợ 24/7</h2>
                                    <p>Nếu có câu hỏi liên hệ đường dây nóng</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                    </div>
                </div>
                <!-- Footer Shipping Area End Here -->
            </div>
        </div>
        <!-- Footer Static Top Area End Here -->
        <!-- Begin Footer Static Bottom Area -->
        <div class="footer-static-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Footer Payment Area -->
                        <div class="copyright text-center">
                            <a href="#">
                                <img src="{{asset('public/frontend/images/payment/1.png')}}" alt="">
                            </a>
                        </div>
                        <!-- Footer Payment Area End Here -->
                        <!-- Begin Copyright Area -->
                        <div class="copyright text-center pt-25">
                            <span><a href="https://www.templatespoint.net" target="_blank">Templates Point</a></span>
                        </div>
                        <!-- Copyright Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Bottom Area End Here -->
    </div>
    <!-- Footer Area End Here -->
    </div>
    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('public/frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('public/frontend/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <!-- Ajax Mail js -->
    <script src="{{asset('public/frontend/js/ajax-mail.js')}}"></script>
    <!-- Meanmenu js -->
    <script src="{{asset('public/frontend/js/jquery.meanmenu.min.js')}}"></script>
    <!-- Wow.min js -->
    <script src="{{asset('public/frontend/js/wow.min.js')}}"></script>
    <!-- Slick Carousel js -->
    <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific popup js -->
    <script src="{{asset('public/frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Isotope js -->
    <script src="{{asset('public/frontend/js/isotope.pkgd.min.js')}}"></script>
    <!-- Imagesloaded js -->
    <script src="{{asset('public/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Mixitup js -->
    <script src="{{asset('public/frontend/js/jquery.mixitup.min.js')}}"></script>
    <!-- Countdown -->
    <script src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script>
    <!-- Counterup -->
    <script src="{{asset('public/frontend/js/jquery.counterup.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('public/frontend/js/waypoints.min.js')}}"></script>
    <!-- Barrating -->
    <script src="{{asset('public/frontend/js/jquery.barrating.min.js')}}"></script>
    <!-- Jquery-ui -->
    <script src="{{asset('public/frontend/js/jquery-ui.min.js')}}"></script>
    <!-- Venobox -->
    <script src="{{asset('public/frontend/js/venobox.min.js')}}"></script>
    <!-- Nice Select js -->
    <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('public/frontend/js/scrollUp.min.js')}}"></script>
    <!-- Main/Activator js -->
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/toastr/toastr.min.js')}}"></script>
    {{-- Moment js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('public/backend/Admin/Layout/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript">
        @if(session('msg'))
        toastr.options = {
            "timeOut": 2000 // 3s
            // , "progressBar": true
        }
        toastr.success("{{ session('msg') }}");
        @endif

        @if(session('error'))
        toastr.options = {
            "timeOut": 2000 // 3s
            // , "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif

        @if(session('warning'))
        toastr.options = {
            "timeOut": 2000 // 3s
            // , "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
        @endif

    </script>
    @yield('js')
</body>

<!-- index30:23-->
</html>
