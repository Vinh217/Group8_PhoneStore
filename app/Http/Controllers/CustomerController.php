<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomerController extends Controller
{
    // public function guard()
    // {
    //     return Auth::guard('customer');
    // }
    // home-page

    function info($id) {
        $customer =  Customer::whereId($id)->first();
        return view('Home.infocustomer',compact('customer'));
    }

    function changepass($id) {
        $customer =  Customer::whereId($id)->first();
        return view('Home.changepass',compact('customer'));
    }

    function updatepassword(Request $request,$id) {
        $request->validate([
            'oldpass' => 'required',
            'password' => ['required',
               'min:6',
               'max:30',
               'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
               'different:oldpass'],
            'cpassword' => 'required|min:5|max:30|same:password'
        ],
        [
            'oldpass.required' => 'Chưa nhập mật khẩu cũ',
            'password.required' => 'Chưa nhập mật khẩu mới',
            'cpassword.required' => 'Chưa nhập lại mật khẩu',
        ]
    );

        $customer = Customer::findOrFail($id);
        if (Hash::check($request->oldpass, $customer->password)) {
           $customer->fill([
            'password' => Hash::make($request->password)
            ])->save();

        //    $request->session()->flash('msg', 'Đổi mật khẩu thành công');
            return redirect()->route('user.signout')->with('msg', 'Đổi mật khẩu thành công');

        } else {
            // $request->session()->flash('fail', 'Mật khẩu cũ không khớp');
            // return redirect()->route('user.changepass',['id' => $id]);
            return redirect()->back()->with('error', 'Mật khẩu cũ không khớp');
        }


    }

    function register(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
            'password' => ['required',
               'min:6',
               'max:30',
               'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'cpassword' => 'required|min:5|max:30|same:password'
        ],
        [
            'The email must be a valid email address.',
            'The password must be at least 10 characters.',
            'The password format is invalid.',
        ]);

        $user = new Customer();
        $user->name = $request->name;
        $user->phone = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        } else {
            return redirect()->back()->with('error', 'Đăng ký thất bại');
        }
    }

    function check(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'Email chưa tồn tại !'
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($creds)) {
            // return redirect()->route('main-page');
            // return redirect()->action([HomeController::class, 'index']);
            return redirect()->intended('main-page');
        } else {
            return redirect()->route('user.login')->with('error', 'Thông tin đăng nhập không chính xác!');
        }
    }

    function logout()
    {
        Auth::guard('customer')->logout();
        Cart::destroy();
        return redirect()->route('user.login');
    }

    //admin
    public function index()
    {
        $customers = Customer::all();
        return view('Admin.customers.listCustomer', compact('customers'));
    }

    public function create()
    {
        return view('Admin.customers.addCustomer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
            'password' => ['required',
            'min:6',
            'max:30',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        try {
            DB::beginTransaction();
            // Logic For Save User Data

            $create_user = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make('password')
            ]);

            if (!$create_user) {
                DB::rollBack();

                return back()->with('error', 'Có vấn đề trong lúc lưu dữ liệu');
            }

            DB::commit();
            return redirect()->route('customers.index')->with('status', 'Customer Stored Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function edit($id)
    {
        $customer =  Customer::whereId($id)->first();

        if (!$customer) {
            return back()->with('error', 'Customer Not Found');
        }

        return view('Admin.customers.editCustomer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
        ]);

        try {
            DB::beginTransaction();
            // Logic For Save User Data

            $update_user = Customer::where('id', $id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            // if (!$update_user) {
            //     DB::rollBack();

            //     return back()->with('error', 'Something went wrong while update user data');
            // }

            DB::commit();
            if($request->hiddeninput) {
                return redirect()->route('main-page')->with('msg', 'Cập nhật thông tin thành công');
            }
            return redirect()->route('customers.index')->with('status', 'Cập nhật thông tin thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    // public function destroy($id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $delete_user = Customer::whereId($id)->delete();

    //         if (!$delete_user) {
    //             DB::rollBack();
    //             return back()->with('error', 'There is an error while deleting user.');
    //         }

    //         DB::commit();
    //         return redirect()->route('customers.index')->with('status', 'User Deleted successfully.');
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw $th;
    //     }
    // }

    public function updateStatus($customer_id, $status_code)
    {
        try {
            $update_customer = Customer::whereId($customer_id)->update([
                'status' => $status_code
            ]);

            if ($update_customer) {
                return redirect()->route('customers.index')->with('status', 'Cập nhật trạng thái thành công');
            }

            return redirect()->route('customers.index')->with('error', 'Cập nhật trạng thái thất bại');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
