<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exeptions\SQLException;
use App\Models\LikedRestaurant;

class GetFavouritesController extends Controller
{
    public function getFavourited(Request $request)
    {
        $id_user = session("logged_user_id");
        $id_restaurant = $request->input("id");

        if($request->isMethod("get"))
        {
            try {
                $likedRestaurant = new LikedRestaurant();
                $likedRestaurant->id_user = $id_user;
                $likedRestaurant->id_restaurant = $id_restaurant;
                $likedRestaurant->save();

                return response()->json(['status' => 'favourited']);
            }catch (SQLException $e) {
                $e->__construct("The restaurant cannot be favourited!");
            }
        }
    }
}


?>