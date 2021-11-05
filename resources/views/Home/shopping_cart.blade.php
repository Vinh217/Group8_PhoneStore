@extends('layouts.home_layout')
@section('content')
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">remove</th>
                                    <th class="li-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                                    <th class="li-product-quantity">Quantity</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $row)
                                <tr>
                                    <td class="li-product-remove"><a href="{{ route('user.cartRemove' ,['id'=> $row->rowId]) }}"><i class="fa fa-times"></i></a></td>
                                    <td><img src="{{ asset('public/backend/uploads/product-images/'.$row->options->photo) }}" height="50" width="auto"></td>
                                    <td class="li-product-name"><a href="#">{{$row->name}}</a></td>
                                    <td class="li-product-price"><span class="amount">{{$row->price}}₫</span></td>
                                    <td class="quantity">
                                        {{-- <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="{{$row->qty}}" type="text">
                                            <a class="" href=" {{ route('user.decreaseCart' ,['rowid' => $row->rowId]) }}">
                                            <div class="dec qtybutton">
                                                <i class="fa fa-angle-down"></i></div>
                                            </a>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div> --}}
                                        <div class="cart-minus d-flex flex-column">
                                            <a class="" href=" {{ route('user.increaseCart' ,['rowid' => $row->rowId]) }}"><i class="fa fa-angle-up"></i></a>
                                            <span class="qty border">{{$row->qty}}</span>
                                            <a class="" href=" {{ route('user.decreaseCart' ,['rowid' => $row->rowId]) }}"><i class="fa fa-angle-down"></i></a>
                                        </div>

                                    </td>
                                    <td class="product-subtotal"><span class="amount">{{number_format($row->priceTotal) }}₫</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </div>
                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal <span>$130.00</span></li>
                                    <li>Total <span>{{ Cart::priceTotal(0) }}</span></li>
                                </ul>
                                <a href="#">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
@endsection
