<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    function create(Request $request){
        //Validate Inputs
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers,email',
            'phone_number'=>'required',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user = new Customer();

        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->phone = $request->phone_number;
        $user->email = $request->email;
        $save = $user->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully');
        }else{
            return redirect()->back()->with('fail','Something went wrong, failed to register');
        }
  }

  function check(Request $request){
    //Validate Inputs
    $request->validate([
       'email'=>'required|email|exists:customers,email',
       'password'=>'required|min:5|max:30'
    ],[
        'email.exists'=>'This email is not exists in customers table'
    ]);

    $creds = $request->only('email','password');

    if( Auth::guard('customer')->attempt($creds) ){
        return redirect()->route('home');
    }else{
        return redirect()->route('user.login')->with('fail','Incorrect credentials');
    }
}

function logout(){
   Auth::guard('customer')->logout();
   return redirect()->route('user.login');
}
}
