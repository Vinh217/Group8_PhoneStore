<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function getAllOrder()
    {
        $order = Order::orderByRaw('TrangThai=0 DESC,SOHDB ASC')->get();
        // $order = DB::select('select * from `order` ORDER BY TrangThai=0 DESC,SOHDB ASC')->ge();
        $order_count = Order::where('TrangThai', '=', '0')->count();
        $customer_count = Customer::where('status', '=', '1')->count();
        $product_count = Product::where('TrangThai', '=', '1')->count();
        return view("Admin.dashboard", compact('order', 'order_count', 'customer_count', 'product_count'));
    }

    public function getOrderDetail($order_id)
    {
        if (!is_numeric($order_id))
            return response()->json([
                'status' => 'failed',
                'message' => 'Error'
            ], 500);
        $order_detail = OrderDetail::where('SoHDB', '=', $order_id)
            ->join('product', 'product.MaDT', '=', 'orderdetail.MaDT')
            ->select(
                'product.TenDT as TenDT',
                'product.MaDT as MaDT',
                'orderdetail.Mau as Mau',
                'orderdetail.SoLuong as SoLuong',
                'orderdetail.DonGiaBan as DonGiaBan',
            )
            ->get();
        return response()->json($order_detail, 200);
    }

    public function confirmOrder($id)
    {
        if (!is_numeric($id))
            return response()->json([
                'status' => 'failed',
                'message' => 'Error'
            ], 500);
        $order = Order::find($id);
        if ($order == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not found'
            ], 404);
        } else {
            if ($order->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => '????n h??ng ???? ???????c x??c nh???n t??? tr?????c!'
                ]);
            }
            if ($order->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'X??c nh???n ????n h??ng th??nh c??ng!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'L???i khi th???c hi???n thao t??c'
                ]);
            }
        }
    }

    public function cancelOrder($id)
    {
        if (!is_numeric($id))
            return response()->json([
                'status' => 'failed',
                'message' => 'Error'
            ], 500);
        $order = Order::find($id);
        if ($order == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not found'
            ], 404);
        } else {
            if ($order->TrangThai == -1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => '????n h??ng ???? ???????c h???y t??? tr?????c!'
                ]);
            }
            if ($order->update(['TrangThai' => -1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'H???y ????n h??ng th??nh c??ng!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'L???i khi th???c hi???n thao t??c'
                ]);
            }
        }
    }
}
