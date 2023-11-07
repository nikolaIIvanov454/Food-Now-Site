<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    protected function index()
    {
        $items = Cart::instance()->content();

        return view('basket')->with('basket_items', $items);

        //implement the shopping cart composer package
    }
}


?>