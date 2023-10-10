<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Region;


class RestaurantListController extends Controller
{
    public function loadRestaurants(Request $request)
    {
        $municipality = $request->input('oblast');

        //$regions = Region::all()->where('city', $municipality);

        $restaurants_filtered = Restaurant::all()->where('region', $municipality);

        return back()->with("restaurants", $restaurants_filtered);
    }
}

?>