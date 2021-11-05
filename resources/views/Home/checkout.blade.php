@extends('layouts.home_layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Checkout</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="coupon-accordion">
                    <!--Accordion Start-->
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input placeholder="Coupon code" type="text">
                                    <input value="Apply Coupon" type="submit">
                                </p>
                            </form>
                        </div>
                    </div>
                    <!--Accordion End-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <form action="{{route('user.orderadd')}}" method="POST" id="formorder">
                    @csrf
                    <div class="checkbox-form">
                        <h3>Chi tiết hoá đơn</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="country-select clearfix">
                                    <label>Country <span class="required">*</span></label>
                                    <select class="nice-select wide">
                                        <option data-display="Việt Nam">Việt Nam</option>
                                        <option value="uk">Thái Lan</option>
                                        <option value="rou">Trung Quốc</option>
                                        <option value="fr">Lào</option>
                                        <option value="de">Malaysia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>First Name <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="firstname" placeholder="Enter first name" value="{{ old('firstname') }}">
                                    <span class="text-danger">@error('firstname'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Last Name <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="lastname" placeholder="Enter last name" value="{{ old('lastname') }}">
                                    <span class="text-danger">@error('lastname'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="address" placeholder="Enter address" value="{{ old('address') }}">
                                    <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="city" placeholder="Enter city/town name" value="{{ old('city') }}">
                                    <span class="text-danger">@error('city'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>State / County <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="state" placeholder="Enter city/state name" value="{{ old('state') }}">
                                    <span class="text-danger">@error('state'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="postcode" placeholder="Enter postcode/zip" value="{{ old('postcode') }}">
                                    <span class="text-danger">@error('postcode'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <input class="mb-0" type="text" class="form-control" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}">
                                    <span class="text-danger">@error('phone_number'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="order-notes">
                            <div class="checkout-form-list">
                                <label>Order Notes</label>
                                <textarea id="checkout-mess" cols="30" rows="10" name="order_note"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-12">
                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Product</th>
                                    <th class="cart-product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $row)
                                <tr class="cart_item">
                                    <td class="cart-product-name"> {{$row->name}}<strong class="product-quantity">
                                            × {{$row->qty}}</strong></td>
                                    <td class="cart-product-total"><span class="amount">{{$row->priceTotal}}₫</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">{{Cart::priceTotal(0)}}₫</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><strong><span class="amount">{{Cart::priceTotal(0)}}₫</span></strong></td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="#payment-1">
                                        <h5 class="panel-title">
                                            <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Direct Bank Transfer.
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order
                                                ID as the payment reference. Your order won’t be shipped until the funds
                                                have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="#payment-2">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Thanh toán bằng thẻ
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order
                                                ID as the payment reference. Your order won’t be shipped until the funds
                                                have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="#payment-3">
                                        <h5 class="panel-title">
                                            <form action="{{route('user.payment')}}" method="POST">
                                                @csrf
                                                <button type="submit" id="checkout-button" class="btn-primary btn">
                                                    <i class="fa fa-paypal " aria-hidden="true"></i>
                                                </button>
                                              </form>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <input value="Place order" type="submit" form="formorder">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout Area End-->

@endsection
