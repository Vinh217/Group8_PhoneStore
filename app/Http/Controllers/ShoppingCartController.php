<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        # code...
        return view("Home.shopping_cart");
    }
}
