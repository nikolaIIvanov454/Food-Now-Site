<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Food;
use App\Models\LikedRestaurant;
use App\Models\Review;

use App\Events\AddProductToCart;

use Cart;

class RestaurantController extends Controller
{
    protected function loadRestaurantsUnfiltered(Request $request)
    {
        $restaurants_unfiltered = Restaurant::all();

        return view('home')->with('restaurants_unfiltered', $restaurants_unfiltered);
    }

    protected function loadRestaurants(Request $request)
    {
        $municipality = $request->input('oblast');
        
        $restaurants_filtered = Restaurant::all()->where('region', $municipality);

        return back()->with('restaurants', $restaurants_filtered);
    }

    protected function getFavourited(Request $request)
    {
        $id_user = session('logged_user_id');
        $id_restaurant = $request->input('id');

        $operation = LikedRestaurant::checkFavourited($id_user);

        if ($id_restaurant) {
            $operation = LikedRestaurant::favouriteLogic($id_user, $id_restaurant);
        }

        return $operation;
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