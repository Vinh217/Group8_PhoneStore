<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShoppingCartController extends Controller
{
    public function index()
    {
        # code...
        return view("Home.shopping_cart");
    }

    public function addToCart($id,Request $req) {
        $listProduct = Product::join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
                              ->join('product_quantity','product.MaDT','=','product_quantity.MaDT')
                              ->find($id);

        $reqQty = $req->input('qtyproduct');
        if($listProduct->SoLuong > 0)
        {
        Cart::add(['id' => $listProduct->MaDT, 'name' => $listProduct->TenDT, 'qty' => !$reqQty ? 1 : $reqQty, 'price' => $listProduct->DonGiaBan , 'weight' => $listProduct->SoLuong,'options' => ['photo' => $listProduct->Anh]]);
        return back()->with('msg','Đã thêm vào giỏ hàng!');
        }
        else {
            return back()->with('msg','Đã hết số lượng trong kho!');
        }
    }

    function increaseCart($rowid){
        $ww=Cart::get($rowid);
        // $soluong = Quantity::where('MaDT','=',$ww->id)->get();
        $quantity=$ww->qty;
        if($ww->weight > $quantity ) {
        Cart::update($rowid,$quantity+=1);
        return back();
        }
        else{
            return back()->with('msg','Đã hết số lượng trong kho!');
        }
    }
    function decreaseCart($rowid) {
        $ww=Cart::get($rowid);
        $quantity=$ww->qty;
        Cart::update($rowid,$quantity-=1);
        return back();
    }

    public function cartRemove($id)
    {
        Cart::remove($id);
        return back();
    }

    public function checkout() {
        return view('Home.checkout');
    }

    public function orderAdd(Request $req) {
        if(Cart::priceTotal()==0){
            return back()->with('msg','Không có sản phẩm để đặt hàng');
        }
        $req->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
        ]);
        $order = new Order();
        $order->NgayDatHang =  Carbon::now();
        $order->DiaChi = $req->address;
        $order->SoDienThoai = $req->phone_number;
        $order->GhiChu = $req->order_note;
        $order->TongTien = str_replace(',','',Cart::priceTotal(0));
        $order->TrangThai = 1;
        $order->EmailKH = $req->email;
        $order->TenKH = $req->firstname. ' '.$req->lastname;
        $order->save();

        foreach(Cart::content() as $c){
            $od = new Order_Detail();
            $od->SoHDB = $order->SoHDB;
            $od->MaDT = $c->id;
            $od->SoLuong = $c->qty;
            $od->DonGiaBan = $c->price;
            $od->save();
        }

        Cart::destroy();
        return back()->with('msg','Đặt hàng thành công');
    }
}
