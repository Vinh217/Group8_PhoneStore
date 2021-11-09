@extends('layouts.home_layout')
@section('content')
<!-- Begin Slider With Banner Area -->
<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Slider Area -->
            <div class="col-lg-8 col-md-8">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">

                        @foreach ($slide as $slide)
                        <div class="single-slide align-center-left  animation-style-01 bg-1" style="background-image: url('{{ asset('public/backend/uploads/banners/'.$slide->Anh)}}');">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>{!! $slide->NoiDung !!}</h5>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Begin Single Slide Area -->
                        {{-- <div class="single-slide align-center-left  animation-style-01 bg-1" style="background-image: url('{{ asset('public/frontend/images/product/large-size/10.jpg')}}');">
                        <div class="slider-progress"></div>
                        <div class="slider-content">
                            <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                            <h2>Chamcham Galaxy S9 | S9+</h2>
                            <h3>Starting at <span>$1209.00</span></h3>
                            <div class="default-btn slide-btn">
                                <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Slide Area End Here -->
                    <!-- Begin Single Slide Area -->
                    <div class="single-slide align-center-left animation-style-02 bg-2">
                        <div class=" slider-progress"></div>
                        <div class="slider-content">
                            <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                            <h2>Work Desk Surface Studio 2018</h2>
                            <h3>Starting at <span>$824.00</span></h3>
                            <div class="default-btn slide-btn">
                                <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                            </div>
                        </div>
                        <!-- Single Slide Area End Here -->
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left animation-style-01 bg-3">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                <h2>Phantom 4 Pro+ Obsidian</h2>
                                <h3>Starting at <span>$1849.00</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Single Slide Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                @foreach ($top_banner as $top)
                @if($loop->first)
                <div class="li-banner">
                    <a href="#">
                        <img src="{{ asset('public/backend/uploads/banners/'.$top->Anh)}}" alt="">
                    </a>
                </div>
                @endif
                @if($loop->last)
                <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                    <a href="#">
                        <img src="{{asset('public/backend/uploads/banners/'.$top->Anh)}}" alt="">
                    </a>
                </div>
                @endif
                @endforeach
            </div>
            <!-- Li Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Slider With Banner Area End Here -->
<!-- Begin Product Area -->
<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        {{-- <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li> --}}
                        <li><a class="active" data-toggle="tab" href="#li-bestseller-product"><span>BestSeller</span></a></li>
                        {{-- <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li> --}}
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="li-bestseller-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($bestSeller as $best)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$best->image[0]->Anh)}}" alt="Product's Image">
                                    </a>
                                    <span class="sticker" style="background-color: red">Hot</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="shop-left-sidebar.html">{{ $best->supplier->TenNSX }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    @for($i = 0; $i < 5; $i++) @if($i <floor($best->DanhGia))
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        @else
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                        @endfor
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">{{$best->TenDT}}</a></h4>
                                        <div class="price-box">
                                            @if($best->quantity->count() >0)
                                            <span class="new-price">{{ number_format($best->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            @foreach ($mid_banner as $mid)
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('public/backend/uploads/banners/'.$mid->Anh)}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>{{ $first_list[0]->supplier->TenNSX }}</span>
                    </h2>
                    <ul class="li-sub-category-list">
                        {{-- <li class="active"><a href="shop-left-sidebar.html">Prime Video</a></li>
                        <li><a href="shop-left-sidebar.html">Computers</a></li>
                        <li><a href="shop-left-sidebar.html">Electronics</a></li> --}}
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($first_list as $item)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{  url('product-detail/'.$item->MaDT) }}">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$item->image[0]->Anh)}}" alt="">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="shop-left-sidebar.html">{{$item->supplier->TenNSX}}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    @for($i = 0; $i < 5; $i++) @if($i <floor($item->DanhGia))
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        @else
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                        @endfor
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">{{$item->TenDT}}</a></h4>
                                        <div class="price-box">
                                            @if($item->quantity->count() >0)
                                            <span class="new-price">{{ number_format($item->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter" onclick="return Detail('{{ $item->MaDT}}',this)"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's TV & Audio Product Area -->
@if(count($second_list)>0)
<section class="product-area li-laptop-product li-tv-audio-product pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>{{ $second_list[0]->supplier->TenNSX }}</span>
                    </h2>
                    <ul class="li-sub-category-list">
                        <li class="active"><a href="shop-left-sidebar.html">Chamcham</a></li>
                        <li><a href="shop-left-sidebar.html">Sanai</a></li>
                        <li><a href="shop-left-sidebar.html">Meito</a></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($second_list as $item)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{  url('product-detail/'.$item->MaDT) }}">
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$item->image[0]->Anh)}}" alt="">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="shop-left-sidebar.html">{{$item->supplier->TenNSX}}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    @for($i = 0; $i < 5; $i++) @if($i <floor($item->DanhGia))
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        @else
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                        @endfor
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="single-product.html">{{$item->TenDT}}</a></h4>
                                        <div class="price-box">
                                            @if($item->quantity->count() >0)
                                            <span class="new-price">{{ number_format($item->quantity[0]->DonGiaBan) }}₫</span>
                                            @else
                                            <span class="new-price">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
@endif
<!-- Li's TV & Audio Product Area End Here -->
<!-- Begin Li's Static Home Area -->
<div class="li-static-home mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Static Home Image Area -->
                <div class="li-static-home-image" style="background-image: url('{{ asset('public/backend/uploads/banners/'.$bottom_banner->Anh)}}');"></div>
                <!-- Li's Static Home Image Area End Here -->
                <!-- Begin Li's Static Home Content Area -->
                {{-- <div class="li-static-home-content">
                    <p>Sale Offer<span>-20% Off</span>This Week</p>
                    <h2>Featured Product</h2>
                    <h2>Meito Accessories 2018</h2>
                    <p class="schedule">
                        Starting at
                        <span> $1209.00</span>
                    </p>
                    <div class="default-btn">
                        <a href="shop-left-sidebar.html" class="links">Shopping Now</a>
                    </div>
                </div> --}}
                <!-- Li's Static Home Content Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Li's Static Home Area End Here -->


<!-- Begin Quick View | Modal Area -->
<div class="modal fade modal-wrapper" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <!-- Product Details Left -->
                        <div class="product-details-left">
                            <div class="product-details-images slider-navigation-1">
                                <div class="lg-image">
                                    <img src="{{asset('public/frontend/images/product/large-size/1.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{asset('public/frontend/images/product/large-size/2.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{asset('public/frontend/images/product/large-size/3.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{asset('public/frontend/images/product/large-size/4.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{asset('public/frontend/images/product/large-size/5.jpg')}}" alt="product image">
                                </div>
                                <div class="lg-image">
                                    <img src="{{asset('public/frontend/images/product/large-size/6.jpg')}}" alt="product image">
                                </div>
                            </div>
                            <div class="product-details-thumbs slider-thumbs-1">
                                <div class="sm-image"><img src="{{asset('public/frontend/images/product/small-size/1.jpg')}}" alt="product image thumb"></div>
                                <div class="sm-image"><img src="{{asset('public/frontend/images/product/small-size/2.jpg')}}" alt="product image thumb"></div>
                                <div class="sm-image"><img src="{{asset('public/frontend/images/product/small-size/3.jpg')}}" alt="product image thumb"></div>
                                <div class="sm-image"><img src="{{asset('public/frontend/images/product/small-size/4.jpg')}}" alt="product image thumb"></div>
                                <div class="sm-image"><img src="{{asset('public/frontend/images/product/small-size/5.jpg')}}" alt="product image thumb"></div>
                                <div class="sm-image"><img src="{{asset('public/frontend/images/product/small-size/6.jpg')}}" alt="product image thumb"></div>
                            </div>
                        </div>
                        <!--// Product Details Left -->
                    </div>

                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="product-details-view-content pt-60">
                            <div class="product-info">
                                <h2>Today is a good day Framed poster</h2>
                                <span class="product-details-ref">Reference: demo_15</span>
                                <div class="rating-box pt-20">
                                    <ul class="rating rating-with-review-item">
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="review-item"><a href="#">Read Review</a></li>
                                        <li class="review-item"><a href="#">Write Review</a></li>
                                    </ul>
                                </div>
                                <div class="price-box pt-20">
                                    <span class="new-price new-price-2">$57.98</span>
                                </div>
                                <div class="product-desc">
                                    <p>
                                        <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                        </span>
                                    </p>
                                </div>
                                <div class="product-variants">
                                    <div class="produt-variants-size">
                                        <label>Dimension</label>
                                        <select class="nice-select">
                                            <option value="1" title="S" selected="selected">40x60cm</option>
                                            <option value="2" title="M">60x90cm</option>
                                            <option value="3" title="L">80x120cm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="single-add-to-cart">
                                    <form action="#" class="cart-quantity">
                                        <div class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <button class="add-to-cart" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="product-additional-info pt-25">
                                    <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                    <div class="product-social-sharing pt-25">
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                            <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View | Modal Area End Here -->
@endsection

@section('js')
<script type="text/javascript">
    function Detail(id, ctl) {
        $.ajax({
            type: 'GET'
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
            }
            , url: '/Group8_PhoneStore/json/product-detail/' + id
            , success: function(result) {
                if (result.status == 'success') {
                    console.log("success");
                    console.log(result.message);
                    // ShowAlert('Deleted!', result.message, 'success');
                } else {
                    // ShowAlert('Error...', result.message, 'error');
                    console.log("error");
                    console.log(result.message);
                }
            }
        }).fail(function(data) {
            console.log("Faile")
            // ShowAlert('Oops...', 'Something went wrong!', 'error');
        });
    }

    function ShowAlert(title, text, icon) {
        Swal.fire({
            title: title
            , text: text
            , icon: icon
        });
    }

</script>

@endsection
