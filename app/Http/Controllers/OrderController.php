<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function getAllOrder()
    {
        $order = Order::all();
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
                    'message' => 'Đơn hàng đã được xác nhận từ trước!'
                ]);
            }
            if ($order->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xác nhận đơn hàng thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
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
                    'message' => 'Đơn hàng đã được hủy từ trước!'
                ]);
            }
            if ($order->update(['TrangThai' => -1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Hủy đơn hàng thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }
}
