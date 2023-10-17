<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Food;


class RestaurantController extends Controller
{
    protected function loadRestaurants(Request $request)
    {
        $municipality = $request->input('oblast');

        $restaurants_filtered = Restaurant::all()->where('region', $municipality);

        return back()->with("restaurants", $restaurants_filtered);
    }

    protected function loadClickedRestaurant(Request $request)
    {
        $id = $request->input('id');

        $restaurant = Restaurant::all()->where('id_restaurant', $id);

        $foods_filtered = Food::all()->where('id_restaurant', $id);

        return view('restaurant')->with([
            "loaded_restaurant" => $restaurant,
            "loaded_foods" => $foods_filtered
        ]);
    }
}

?>