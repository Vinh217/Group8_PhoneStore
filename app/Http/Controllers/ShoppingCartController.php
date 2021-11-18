<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;

class ShoppingCartController extends Controller
{
    public $gateway;
    public $completePaymentUrl;

    public function __construct()
    {
        $this->gateway = Omnipay::create('Stripe\PaymentIntents');
        $this->gateway->setApiKey(env('STRIPE_SECRET_KEY'));
        $this->completePaymentUrl = url('confirm');
    }


    public function index()
    {
        # code...
        return view("Home.shopping_cart");
    }

    public function addToCart($id, Request $req)
    {
        if ($req->color) {
            // $listProduct = Product::find($id);
            //     ->join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
            //     ->join('product_quantity', 'product.MaDT', '=', 'product_quantity.MaDT')
            //     ->where('product_quantity.Mau', '=', $req->color)
            //     ->
            $listProduct = Product::where('MaDT',$id)->select(['MaDT','TenDT'])
                ->with('image')
                ->with(['quantity' => function($q) use($req) {
                    $q->where('Mau', '=', $req->color);
                }])
                ->first();

        } else {
            // $listProduct = Product::join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
            //     ->join('product_quantity', 'product.MaDT', '=', 'product_quantity.MaDT')
            //     ->find($id);
            $listProduct = Product::find($id);
        }

        // dd($listProduct);
        // return $listProduct->quantity[0]->Mau;
        // return $listProduct->quantity->Mau;

        // dd($listProduct);

        $reqQty = $req->input('qtyproduct');
        // $cartitem = Cart::content()->where('id', $id);
        // dd($cartitem);
        $cartitem = Cart::search(function($cartItem, $rowId) use($req,$id) {
            return $cartItem->id == $id && $cartItem->options->color== $req->color;
        });
        // dd($cartitem);
        // echo $listProduct->SoLuong;
        // echo $req->color;

        if (!$reqQty)
            $reqQty = 0;
        if (Cart::count() > 0) {
            // $cartitem = Cart::content()->where('id', $id)
            //     ->where('options',$req->color);
            // $checksl = $cartitem->flatten(0)[0]->qty ? $cartitem->flatten(0)[0]->qty : 0;

            if (count($cartitem) == 0)
                $checksl = 0;
            else
                $checksl = $cartitem->flatten(0)[0]->qty;
            // echo $checksl."<br>";
            // echo $reqQty;
            if ($listProduct->quantity[0]->SoLuong >= $checksl + $reqQty) {
                // if ($listProduct->SoLuong > 0) {
                Cart::add(['id' => $listProduct->MaDT, 'name' => $listProduct->TenDT, 'qty' => !$reqQty ? 1 : $reqQty, 'price' => $listProduct->quantity[0]->DonGiaBan, 'weight' => $listProduct->quantity[0]->SoLuong, 'options' => ['photo' => $listProduct->image[0]->Anh, 'color' => $listProduct->quantity[0]->Mau]]);
                return back()->with('msg', 'Đã thêm vào giỏ hàng!');
            } else {
                return back()->with('error', 'Đã hết số lượng trong kho!');
            }
        }
        else {
            if ($listProduct->quantity[0]->SoLuong > 0) {
                Cart::add(['id' => $listProduct->MaDT, 'name' => $listProduct->TenDT, 'qty' => !$reqQty ? 1 : $reqQty, 'price' => $listProduct->quantity[0]->DonGiaBan, 'weight' => $listProduct->quantity[0]->SoLuong, 'options' => ['photo' => $listProduct->image[0]->Anh, 'color' => $listProduct->quantity[0]->Mau]]);
                return back()->with('msg', 'Đã thêm vào giỏ hàng!');
            } else {
                return back()->with('error', 'Đã hết số lượng trong kho!');
            }
        }
    }

    function increaseCart($rowid)
    {
        $ww = Cart::get($rowid);
        // $soluong = Quantity::where('MaDT','=',$ww->id)->get();
        $quantity = $ww->qty;
        if ($ww->weight > $quantity) {
            Cart::update($rowid, $quantity += 1);
            return back();
        } else {
            return back()->with('error', 'Đã hết số lượng trong kho!');
        }
    }
    function decreaseCart($rowid)
    {
        $ww = Cart::get($rowid);
        $quantity = $ww->qty;
        Cart::update($rowid, $quantity -= 1);
        return back();
    }

    public function cartRemove($id)
    {
        Cart::remove($id);
        return back();
    }

    public function checkout()
    {
        if (Cart::priceTotal() == 0) {
            return back()->with('warning', 'Không có sản phẩm trong giỏ hàng để thanh toán');
        }
        return view('Home.checkout');
    }

    public function orderAdd(Request $req)
    {
        $checkpayment = $req->tab;
        if (Cart::priceTotal() == 0) {
            return back()->with('error', 'Không có sản phẩm để đặt hàng');
        }
        $req->validate([
            // 'firstname' => 'required',
            // 'lastname' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone_number' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
        ]);

        if ($checkpayment == 'tructiep') {
            $order = new Order();
            $order->NgayDatHang =  Carbon::now();
            $order->DiaChi = $req->address;
            $order->SoDienThoai = $req->phone_number;
            $order->GhiChu = $req->order_note;
            $order->TrangThai = 0;
            $order->EmailKH = $req->email;
            $order->save();

            foreach (Cart::content() as $c) {
                $od = new Order_Detail();
                $od->SoHDB = $order->SoHDB;
                $od->MaDT = $c->id;
                $od->Mau = $c->options->color;
                $od->SoLuong = $c->qty;
                $od->DonGiaBan = $c->price;
                $od->save();
            }

            Cart::destroy();
            return redirect()->route('main-page')->with('msg', 'Đặt hàng thành công');
        }

        if ($checkpayment == 'stripe') {
            if ($req->input('stripeToken')) {
                $token = $req->input('stripeToken');
                $total = str_replace(',', '', Cart::priceTotal(0));
                $response = $this->gateway->authorize([
                    'amount' => $total,
                    'currency' => env('STRIPE_CURRENCY'),
                    'description' => 'This is a X purchase transaction.',
                    'token' => $token,
                    'returnUrl' => $this->completePaymentUrl,
                    'confirm' => true,
                ])->send();

                if ($response->isSuccessful()) {
                    $response = $this->gateway->capture([
                        'amount' => str_replace(',', '', Cart::priceTotal(0)),
                        'currency' => env('STRIPE_CURRENCY'),
                        'paymentIntentReference' => $response->getPaymentIntentReference(),
                    ])->send();

                    $arr_payment_data = $response->getData();

                    $this->store_payment([
                        'payer_ngaydathang' => Carbon::now(),
                        'payer_diachi' => $req->input('address'),
                        'payer_sdt' => $req->input('phone_number'),
                        'payer_ordernote' =>  $req->input('order_note'),
                        'amount' => $arr_payment_data['amount'],
                        'payer_status' => 1,
                        'payer_email' => $req->input('email'),
                        // 'payer_tenkh' => $req->input('firstname'),
                        'payment_id' => $arr_payment_data['id'],
                    ]);
                    Cart::destroy();
                    return redirect()->route('main-page')->with('msg', 'Đặt hàng thành công');
                } elseif ($response->isRedirect()) {
                    session(['payer_email' => $req->input('email')]);
                    session(['payer_ngaydathang' => Carbon::now()]);
                    session(['payer_diachi' => $req->input('address')]);
                    session(['payer_sdt' => $req->input('phone_number')]);
                    session(['payer_ghichu' => $req->input('order_note')]);
                    $response->redirect();
                } else {
                    return back()->with('error', 'Lỗi rồi!!');
                }
            }
        }
    }

    public function confirm(Request $request)
    {
        $response = $this->gateway->confirm([
            'paymentIntentReference' => $request->input('payment_intent'),
            'returnUrl' => $this->completePaymentUrl,
        ])->send();

        if ($response->isSuccessful()) {
            $response = $this->gateway->capture([
                'amount' => str_replace(',', '', Cart::priceTotal(0)),
                'currency' => env('STRIPE_CURRENCY'),
                'paymentIntentReference' => $request->input('payment_intent'),
            ])->send();

            $arr_payment_data = $response->getData();

            $this->store_payment([
                'payer_ngaydathang' => session('payer_ngaydathang'),
                'payer_diachi' => session('payer_diachi'),
                'payer_sdt' => session('payer_sdt'),
                'payer_ordernote' => session('order_note'),
                'amount' => $arr_payment_data['amount'],
                'payer_status' => 1,
                'payer_email' => session('payer_email'),
                'payer_tenkh' => session('payer_tenkh'),
                'payment_id' => $arr_payment_data['id'],
                // 'currency' => env('STRIPE_CURRENCY'),
            ]);

            Cart::destroy();
            return redirect()->route('main-page')->with('msg', 'Đặt hàng thành công');
        } else {
            return redirect()->route('main-page')->with('error', 'Lỗi rồi');
        }
    }

    public function store_payment($arr_data = [])
    {
        $isPaymentExist = Order::where('payment_id', $arr_data['payment_id'])->first();

        if (!$isPaymentExist) {
            $payment = new Order;
            $payment->NgayDatHang = $arr_data['payer_ngaydathang'];
            $payment->DiaChi = $arr_data['payer_diachi'];
            $payment->SoDienThoai = $arr_data['payer_sdt'];
            $payment->GhiChu = $arr_data['payer_ordernote'];
            // $payment->TongTien = $arr_data['amount'];
            // $payment->currency = env('STRIPE_CURRENCY');
            $payment->TrangThai = $arr_data['payer_status'];
            $payment->EmailKH = $arr_data['payer_email'];
            // $payment->TenKH = $arr_data['payer_tenkh'];
            $payment->payment_id = $arr_data['payment_id'];
            $payment->save();

            foreach (Cart::content() as $c) {
                $od = new Order_Detail();
                $od->SoHDB = $payment->SoHDB;
                $od->MaDT = $c->id;
                $od->Mau = $c->options->color;
                $od->SoLuong = $c->qty;
                $od->DonGiaBan = $c->price;
                $od->save();
            }
        }
    }
}
