<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedRestaurant extends Model
{
    use HasFactory;

    protected $table = 'favourite_restaurants';

    protected $primaryKey = 'id_favourite_restaurant';

    protected $fillable = [
        'id_user',
        'id_restaurant'
    ];

    public static function checkFavourited($id_user){
        $favourited_restaurants = LikedRestaurant::select('id_restaurant')->where('id_user', $id_user)->get();

        return response()->json($favourited_restaurants);
    }

    public static function favouriteLogic($id_user, $id_restaurant){
        $favourited_restaurant = LikedRestaurant::select('id_restaurant')->where('id_restaurant', $id_restaurant)->first();

        if($favourited_restaurant){
            LikedRestaurant::where('id_user', $id_user)->where('id_restaurant', $id_restaurant)->delete();

            return response(['status' => 'unfavourited']);
        }else{
            LikedRestaurant::create([
                'id_user' => $id_user,
                'id_restaurant' => $id_restaurant,
            ]);

            return response(['status' => 'favourited']);
        }
    }
}
