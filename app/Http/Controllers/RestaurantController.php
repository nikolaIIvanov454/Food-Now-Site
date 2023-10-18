<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Food;
use App\Models\LikedRestaurant;


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

        $restaurant = Restaurant::all()->where('id_restaurant', $id)->first();

        $foods_filtered = Food::all()->where('id_restaurant', $id);

        return view('restaurant')->with([
            "loaded_restaurant" => $restaurant,
            "loaded_foods" => $foods_filtered
        ]);
    }

    protected function getFavourited(Request $request)
    {
        $id_user = session("logged_user_id");
        $id_restaurant = $request->input("id");

        //make so that it gets in the else statement!!!

        if(isset($id_user) && isset($id_restaurant))
        {
            $likedRestaurant = new LikedRestaurant();
            $likedRestaurant->id_user = $id_user;
            $likedRestaurant->id_restaurant = $id_restaurant;
            $likedRestaurant->save();

            return response()->json(['status' => 'favourited']);
        }else
        {
            LikedRestaurant::where('id_restaurant', $id_restaurant)->delete();
            //return response()->json(['status' => 'unfavourited']);
        }
        
    }
}

?>