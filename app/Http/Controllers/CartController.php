<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

use Cart;

class CartController extends Controller
{
    protected function start()
    {
        $items = Cart::instance('basket')->content();

        session()->put('items_count', $items->Count());

        //complete the cart logic and representation in the site!!!!

        return view('basket')->with('basket_items', $items);
    }

    protected function addItem(Request $request)
    {   
        $product = Food::where('id_food', $request->id)->first();

        Cart::instance('basket')->add($product->id_food, $product->name, 1, str_replace('лв.', '', $product->price), ['weight' => $product->weight])->associate('App\Models\Food');

        return response()->json(['message' => 'Успешно добавяне!']);
    } 
}

?>