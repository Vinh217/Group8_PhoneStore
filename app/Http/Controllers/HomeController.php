<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        # code...
        return view("Home.home");
    }

    public function singleProduct() {
        return view("Home.single-product");
    }
}
