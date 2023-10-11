<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Region;


class RestaurantListController extends Controller
{
    protected function loadRestaurants(Request $request)
    {
        $municipality = $request->input('oblast');

        $restaurants_filtered = Restaurant::all()->where('region', $municipality);

        return back()->with("restaurants", $restaurants_filtered);
    }

    protected function loadClickedRestaurant(Request $request)
    {
        if ($request->isMethod("post")){
            return view('load-restaurant');
        }
    }
}

?>