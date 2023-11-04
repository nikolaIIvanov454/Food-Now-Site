<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Food;
use App\Models\LikedRestaurant;
use App\Models\Review;

class RestaurantController extends Controller
{
    protected function loadRestaurants(Request $request)
    {
        $municipality = $request->input('oblast');
        
        $restaurants_filtered = Restaurant::all()->where('region', $municipality);

        return back()->with("restaurants", $restaurants_filtered);
    }

    protected function getFavourited(Request $request)
    {
        $id_user = session('logged_user_id');
        $id_restaurant = $request->input('id');

        $favourited_restaurants = LikedRestaurant::select('id_restaurant')->where('id_user', $id_user)->get();

        if($request->input('checkFavourited') == true){
            return response()->json($favourited_restaurants);
        }


        //Make these two in separate functions!!!!


        $favourited_restaurant = LikedRestaurant::select('id_restaurant')->where('id_user', $id_user)->where('id_restaurant', $id_restaurant)->first();

        if($favourited_restaurant){
            LikedRestaurant::where('id_user', $id_user)->where('id_restaurant', $id_restaurant)->delete();
        }else{
            LikedRestaurant::create([
                'id_user' => $id_user,
                'id_restaurant' => $id_restaurant,
            ]);
        }
    }




    protected function loadClickedRestaurant(Request $request)
    {
        $id = $request->input('id');

        $restaurant = Restaurant::all()->where('id', $id)->first();

        $menu = Food::all()->where('id_restaurant', $id);

        $loaded_reviews = Review::getReviews($id);  

        return view('restaurant')->with([
            "loaded_reviews" => $loaded_reviews,
            "loaded_restaurant" => $restaurant,
            "loaded_menu" => $menu
        ]);
    }
}

?>