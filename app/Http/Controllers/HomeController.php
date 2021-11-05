<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $listProduct = Product::join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
                              ->join('product_quantity','product.MaDT','=','product_quantity.MaDT')->get();
        return view("Home.home", compact('listProduct'));
    }

    function searchProduct(Request $req){
        $keyWord = $req->keyword;
        $product = Product::join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
                            ->join('product_quantity','product.MaDT','=','product_quantity.MaDT')
                    ->where('TenDT','like',"%$keyWord%")
                    ->orWhere('product.MaDT','like',"%$keyWord%")
                    ->get();//->stake(30)->paginate(5);
        return view('Home.search_product',compact('keyWord','product'));
    }

    // public function __construct()
    // {
    //     // $this->middleware('auth');
    //     $this->middleware('guest:customer');
    // }
}
