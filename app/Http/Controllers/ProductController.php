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
                'txtTenDT' => ['required'],
                'txtGioiThieu' => ['required'],
                'txtThongSo' => ['required'],
            ],
            [
                'image.required' => 'Bạn chưa thêm ảnh cho sản phẩm',
                'image.*' => 'Upload file không hợp lệ',
                'txtMaDT.unique' => 'Mã sản phẩm đã tồn tại',
                'txtMaDT.required' => 'Bạn chưa nhập mã sản phẩm',
                'txtMaDT.max' => 'Mã sản phẩm quá dài',
                'txtTenDT.required' => 'Bạn chưa nhập tên sản phẩm',
                'txtGioiThieu.required' => 'Bạn chưa nhập nội dung giới thiệu sản phẩm',
                'txtThongSo.required' => 'Bạn chưa nhập thông số cho sản phẩm',
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
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            //Disable nhà sản xuất
            if ($product->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Sản phẩm này đã được ẩn từ trước'
                ]);
            }
            if ($product->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Ẩn thông tin sản phẩm thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }
    public function active($id)
    {
        $product = Product::where('MaDT', "=", $id)->first();
        if ($product === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            if ($product->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Sản phẩm đã được active từ trước'
                ]);
            }
            if ($product->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Active sản phẩm thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }

    public function getNumberInstockByColor($madt, $color)
    {
        $product = Product::join('product_quantity', 'product_quantity.MaDT', '=', 'product.MaDT')
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
        if ($product === null || $product->TrangThai == 0)
            return view("errors.home_404");
        return view('Home.single-product', compact('product'));
    }

    public function productBySupplier($supplierId)
    {
        // $product = DB::table('product')->where('MaNSX', '=', $supplierId)->get();
        $supplier = Supplier::where('MaNSX', '=', $supplierId)->first();
        if ($supplier->TrangThai == 0) {
            return view("errors.home_404");
        }
        $supplier_name = $supplier->TenNSX;
        $product = Product::where('MaNSX', '=', $supplierId)
            ->where('TrangThai', '=', 1);
        switch (request('sortBy')) {
            case 'name_asc':
                $product->orderby('TenDT', 'asc');
                break;
            case 'name_desc':
                $product->orderby('TenDT', 'desc');
                break;
            case 'price_asc':
                $product->withMax('quantity as maxprice', 'DonGiaBan')
                    ->orderBy('maxprice', 'asc');
                break;
            case 'price_desc':
                $product->withMax('quantity as maxprice', 'DonGiaBan')
                    ->orderBy('maxprice', 'desc');
                break;
            default:
                $product->orderby('MaDT', 'asc');
                break;
        }
        $product = $product->paginate(4);
        return view('Home.productBySupplier', compact('product'), compact('supplier_name'));
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

    public function updateQuantity(Request $request)
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
            return response()->json('Dữ liệu không hợp lệ', 500);
        return response()->json("Sửa thông thông tin thành công", 200);
    }
    public function deleteQuantity($id, $color)
    {
        $quantity = Quantity::where('MaDT', '=', $id)
            ->where('Mau', '=', $color)
            ->first();
        if ($quantity === null || $id === "" || $color === "")
            return response()->json([
                'status' => 'failed',
                'message' => 'Not found !!!'
            ], 404);
        if ($quantity->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa thông tin thành công'
            ], 200);
        }
    }
}
