<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\CompleteOrderMailable;

use App\Models\Food;

use App\Events\SuccessfullyAddedProductToCart;
use App\Events\AddProductToCart;
use App\Events\DeleteProductFromCart;

use Cart;

class CartController extends Controller
{
    protected function start()
    {
        $items = Cart::instance('basket')->content();

        return view('basket')->with('basket_items', $items);
    }

    protected function addItem(Request $request)
    {   
        $product = Food::where('id_food', $request->id)->first();

        Cart::instance('basket')->add($product->id_food, $product->name, 1, str_replace('лв.', '', $product->price), ['weight' => $product->weight])->associate('App\Models\Food');

        broadcast(new SuccessfullyAddedProductToCart(['message' => 'Успешно добавяне!', 'items_count' => Cart::instance('basket')->Count()]));
    } 

    protected function removeItem(Request $request)
    {   
        Cart::instance('basket')->remove($request->input('id'));

        broadcast(new DeleteProductFromCart());
    } 

    protected function completeOrder(Request $request){

        $data = [
            'total_price' => $request->input('items-total-price:'),
            'items' =>  json_decode($request->input('items'))
        ];

        Mail::to(auth()->user()->email)->send(new CompleteOrderMailable());

        Cart::instance('basket')->destroy();
    }
}

?>