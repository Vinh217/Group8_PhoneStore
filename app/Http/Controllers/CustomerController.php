<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // public function guard()
    // {
    //     return Auth::guard('customer');
    // }
    // home-page
    function register(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $user = new Customer();
        $user->name = $request->name;
        $user->phone = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'You are now registered successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }

    function check(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'This email is not exists in customers table'
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($creds)) {
            // return redirect()->route('home');
            // return redirect()->action([HomeController::class, 'index']);
            return redirect()->intended();
        } else {
            return redirect()->route('user.login')->with('fail', 'Incorrect credentials');
        }
    }

    function logout()
    {
        Auth::guard('customer')->logout();
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
            'phone' => 'required',
            'password' => 'required|min:5|max:30',
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

                return back()->with('error', 'Something went wrong while saving user data');
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
            'phone' => 'required',
            'password' => 'required|min:5|max:100',
        ]);

        try {
            DB::beginTransaction();
            // Logic For Save User Data

            $update_user = Customer::where('id', $id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make('password')
            ]);

            if (!$update_user) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while update user data');
            }

            DB::commit();
            return redirect()->route('customers.index')->with('status', 'Customer Updated Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $delete_user = Customer::whereId($id)->delete();

            if (!$delete_user) {
                DB::rollBack();
                return back()->with('error', 'There is an error while deleting user.');
            }

            DB::commit();
            return redirect()->route('customers.index')->with('status', 'User Deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updateStatus($customer_id, $status_code)
    {
        try {
            $update_customer = Customer::whereId($customer_id)->update([
                'status' => $status_code
            ]);

            if ($update_customer) {
                return redirect()->route('customers.index')->with('status', 'User Status Updated Successfully.');
            }

            return redirect()->route('customers.index')->with('error', 'Fail to update user status.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
