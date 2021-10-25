<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $listProduct = Product::join('product_image','product.MaDT','=','product_image.MaDT')->get();
        return view("Home.home",compact('listProduct'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
