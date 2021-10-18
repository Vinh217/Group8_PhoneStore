<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //
    public function getAllSupplier()
    {
        $suppliers = Supplier::all();
        return view('Admin.supplier.listSupplier', compact('suppliers'));
    }
    public function add()
    {
        # code...
        return view('Admin.supplier.addSupplier');
    }

    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'txtMaNSX' => ['required', 'unique:supplier,MaNSX', 'max:10'],
                'txtTenNSX' => ['required'],
                'txtDiaChi' => ['required'],
                'txtSDT' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
                'txtEmail' => ['required', 'email:rfc,dns'],
            ],
            [
                'txtMaNSX.required' => 'Mã sản phẩm không được để trống',
                'txtMaNSX.unique' => 'Mã nhà sản xuất đã tồn tại',
                'txtTenNSX.required' => 'Tên nhà sản xuất không được để trống',
                'txtDiaChi.required' => 'Địa chỉ không được để trống',
                'txtSDT.required' => 'Số điện thoại không được để trống',
                'txtSDT.regex' => "Số điện thoại không hợp lệ",
                'txtEmail.required' => 'Email không được để trống',
                'txtEmail.email' => 'Email không hợp lệ',
            ]
        );
        $supplier = new Supplier();
        $supplier->MaNSX  = $request->input('txtMaNSX');
        $supplier->TenNSX  = $request->input('txtTenNSX');
        $supplier->DiaChi  = $request->input('txtDiaChi');
        $supplier->SoDienThoai  = $request->input('txtSDT');
        $supplier->Email  = $request->input('txtEmail');
        $supplier->TrangThai  = $request->input('ddlTrangThai');
        if (!$supplier->save()) {
            return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('error', 'Lỗi khi thêm mới nhà sản xuất');
        } else
            return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('status', 'Thêm mới nhà sản xuất thành công');
    }

    public function edit($id)
    {
        $supplier = DB::table('supplier')->where('MaNSX', "=", $id)->first();
        if ($supplier === null) {
            return view('errors.admin_404');
        }
        return view('Admin.supplier.editSupplier', compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('MaNSX', "=", $id)->first();
        if ($supplier === null) {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                'txtTenNSX' => ['required'],
                'txtDiaChi' => ['required'],
                'txtSDT' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
                'txtEmail' => ['required', 'email:rfc,dns'],
            ],
            [
                'txtDiaChi.required' => 'Địa chỉ không được để trống',
                'txtSDT.required' => 'Số điện thoại không được để trống',
                'txtSDT.regex' => "Số điện thoại không hợp lệ",
                'txtEmail.required' => 'Email không được để trống',
                'txtEmail.email' => 'Email không hợp lệ',
            ]
        );
        $supplier->update([
            'TenNSX'  => $request->input('txtTenNSX'),
            'DiaChi'  => $request->input('txtDiaChi'),
            'SoDienThoai' => $request->input('txtSDT'),
            'Email'  => $request->input('txtEmail'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]);
        return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('status', 'Sửa thông tin nhà sản xuất mã ' . $id . ' thành công');
    }

    public function destroy($id)
    {
        $supplier = Supplier::where('MaNSX', "=", $id)->first();
        if ($supplier === null) {
            return view('errors.admin_404');
        }
        $supplier->update([
            'TrangThai' => 0
        ]);
        return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('status', 'Xóa dữ liệu nhà sản xuất mã ' . $id . ' thành công');
    }
}
