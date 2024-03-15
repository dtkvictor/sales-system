<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function cart() 
    {
        return view('components.pages.shopping.cart');
    }

    public function checkout() 
    {
        return view('components.pages.shopping.checkout');
    }
}
