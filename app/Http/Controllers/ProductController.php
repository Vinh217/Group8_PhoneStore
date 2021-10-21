<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\SoLuong;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 
    public function getAllProduct()
    {
        $product = Product::all();
        return view("Admin.product.listProduct", compact('product'));
    }

    public function add()
    {
        $supplier = Supplier::all();
        return view("Admin.product.addProduct", compact('supplier'));
    }

    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => ['required'],
                'image.*' => ['mimes:jpg,png,jpeg'],
                'txtMaDT' => ['required', 'unique:product,MaDT', 'max:10'],
            ],
            [
                'image.required' => 'Bạn chưa thêm ảnh cho sản phẩm',
                'image.*' => 'Upload file không hợp lệ',
                'txtMaDT.unique' => 'Mã sản phẩm đã tồn tại',
                'txtMaDT.required' => 'Bạn chưa nhập mã sản phẩm',
            ]
        );
        //Tạo sản phẩm
        $product = new Product();
        $product->MaDT  = $request->input('txtMaDT');
        $product->TenDT  = $request->input('txtTenDT');
        $product->GioiThieu = $request->input('txtGioiThieu');
        $product->ThongSo = $request->input('txtThongSo');
        $product->MaNSX  = $request->input('ddlNhaSanXuat');
        $product->TrangThai  = $request->input('ddlTrangThai');
        $product->save();
        if ($request->hasFile('image')) {
            //Xử lý file ảnh
            foreach ($request->file('image') as $file) {
                $ext = $file->getClientOriginalExtension();
                $original_name = $file->getClientOriginalName();
                $filename = time() . $original_name;
                $file->move('public/backend/uploads/product-images/', $filename);
                $image = new Image();
                $image->MaDT = $request->input('txtMaDT');
                $image->Anh = $filename;
                $image->save();
            }
            return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Thêm mới sản phẩm thành công');
        }
        return redirect()->action([ProductController::class, 'getAllProduct'])->with('error', 'Lỗi khi thêm mới sản phẩm');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $supplier = Supplier::all();
        return view('Admin.product.editProduct', compact('product', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('MaDT', "=", $id)->first();
        $product->update([
            'TenDT'  => $request->input('txtTenDT'),
            'GioiThieu'  => $request->input('txtGioiThieu'),
            'ThongSo' => $request->input('txtThongSo'),
            'MaNSX'  => $request->input('ddlNhaSanXuat'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]);
        return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Sửa thông tin sản phẩm mã ' . $id . ' thành công');
    }
    public function destroy($id)
    {
        $product = Product::where('MaDT', "=", $id)->first();
        if ($product === null) {
            return view('errors.admin_404');
        }
        $product->update([
            'TrangThai' => 0
        ]);
        return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Xóa sản phẩm mã ' . $id . ' thành công');
    }

    public function getNumberInstockByColor($madt, $color)
    {
        $product = DB::table('product')
            ->join('product_quantity', 'product_quantity.MaDT', '=', 'product.MaDT')
            ->where('product_quantity.MaDT', '=', $madt)
            ->where('product_quantity.Mau', '=', $color)
            ->select(
                'product_quantity.MaDT as MaDT',
                'product_quantity.Mau as Mau',
                'product_quantity.SoLuong as SoLuong',
                'product_quantity.DonGiaBan as DonGiaBan',
            )
            ->get();
        return response()->json($product, 200);
    }

    public function getProductDetail($id)
    {
        $product = Product::find($id);
        if ($product === null)
            return view("errors.home_404");
        return view('Home.single-product', compact('product'));
    }

    public function productBySupplier($supplierId)
    {
        // $product = DB::table('product')->where('MaNSX', '=', $supplierId)->get();
        $product = Product::where('MaNSX', '=', $supplierId)->get();
        return view('pages.productBySupplier', compact('product'));
    }

    public function productQuantity($id)
    {
        $quantity = Quantity::where('MaDT', '=', $id)->get();
        return view('Admin.product.addProductQuantity', compact('quantity', 'id'));
    }
    public function insertQuantity(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'txtMau' => ['required'],
                'txtSoLuong' => ['required'],
                'txtDonGiaNhap' => ['required'],
                'txtDonGiaBan' => ['required'],
            ],
            [
                'txtMau.required' => 'Bạn chưa nhập màu',
                'txtSoLuong.required' => 'Bạn chưa nhập số lượng ',
                'txtDonGiaNhap.required' => 'Bạn chưa nhập đơn giá nhập',
                'txtDonGiaBan.required' => 'Bạn chưa nhập đơn giá bán',
            ]
        );
        $color =  $request->input('txtMau');
        // $check = DB::table('product_quantity')
        //     ->where('MaDT', '=', $id)
        //     ->where('Mau', '=', $color)
        //     ->first();
        $check = Quantity::where('MaDT', '=', $id)
            ->where('Mau', '=', $color)
            ->first();
        if ($check === null) {
            $quantity = new Quantity();
            $quantity->MaDT = $id;
            $quantity->Mau = $request->input('txtMau');
            $quantity->SoLuong = $request->input('txtSoLuong');
            $quantity->DonGiaNhap = $request->input('txtDonGiaNhap');
            $quantity->DonGiaBan = $request->input('txtDonGiaBan');
            $quantity->save();
        } else {
            $old_quantity = $check->SoLuong;
            $new_quantity = $request->input('txtSoLuong');
            $sum = $old_quantity + $new_quantity;
            $check->update(['SoLuong' => $sum]);

            // Quantity::where('MaDT', '=', $id)
            //     ->where('Mau', '=', $color)
            //     ->update(['SoLuong' => $sum]);
        }
        return redirect()->action([ProductController::class, 'productQuantity'], $id);
    }

    public function updatePrice(Request $request)
    {
        $mau = $request->get("Mau");
        $madt = $request->get("MaDT");
        $dongianhap = $request->get("DonGiaNhap");
        $dongiaban = $request->get("DonGiaBan");
        $soluong = $request->get("SoLuong");

        if (is_numeric($dongianhap) && is_numeric($dongiaban) && is_numeric($soluong)) {
            $quantity = Quantity::where('MaDT', '=', $madt)
                ->where('Mau', '=', $mau)
                ->first();
            if ($quantity === null)
                return response()->json('Not found', 404);
            else {
                $quantity->update([
                    "SoLuong" => $soluong,
                    "DonGiaNhap" => $dongianhap,
                    "DonGiaBan" => $dongiaban
                ]);
            }
        } else
            return response()->json('Invalid Input', 500);
        return response()->json("Sửa thông thông tin thành công", 200);
    }
}
