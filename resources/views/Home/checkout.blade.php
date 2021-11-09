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
                                    <input class="mb-0" type="text" class="form-control" name="firstname"
                                        placeholder="Enter first name" value="{{ old('firstname') }}">
                                    <span class="text-danger">@error('firstname'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Last Name <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="lastname"
                                        placeholder="Enter last name" value="{{ old('lastname') }}">
                                    <span class="text-danger">@error('lastname'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="address"
                                        placeholder="Enter address" value="{{ old('address') }}">
                                    <span class="text-danger">@error('address'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="city"
                                        placeholder="Enter city/town name" value="{{ old('city') }}">
                                    <span class="text-danger">@error('city'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>State / County <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="state"
                                        placeholder="Enter city/state name" value="{{ old('state') }}">
                                    <span class="text-danger">@error('state'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    <input class="mb-0" type="text" class="form-control" name="postcode"
                                        placeholder="Enter postcode/zip" value="{{ old('postcode') }}">
                                    <span class="text-danger">@error('postcode'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Enter email address" value="{{ old('email') }}">
                                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <input class="mb-0" type="text" class="form-control" name="phone_number"
                                        placeholder="Enter phone number" value="{{ old('phone_number') }}">
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

                        <div class="payment-method">
                            <h3>Phương thức thanh toán</h3>
                            <input type="radio" id="offline" name="tab" value="tructiep" onclick="show1();"
                                style="width:20px;height:15px">
                            <label for="offline">Thanh toán trực tiếp</label><br>
                            <input type="radio" id="paypal" name="tab" value="stripe" onclick="show2();"
                                style="width:20px;height:15px">
                              <label for="paypal">Thanh toán bằng thẻ</label><br>
                            <div id="card-element" style="display: none;">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
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
                                    <td class="cart-product-total"><span class="amount">{{$row->priceTotal}}₫</span>
                                    </td>
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
                        <div class="order-button-payment">
                            <input value="Place order" type="submit" form="formorder">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout Area End-->
<script>
    function show1(){
         document.getElementById('card-element').style.display ='none';
        //  document.getElementById('card-errors').style.display ='none';
    }
    function show2(){
        document.getElementById('card-element').style.display = 'block';
        // document.getElementById('card-errors').style.display = 'block';
    }
</script>

@endsection

@section('js')
<script>
    var publishable_key = '{{ env('STRIPE_PUBLISHABLE_KEY') }}';
    </script>
    <script src="{{ asset('/public/frontend/js/card.js') }}"></script>
@endsection
