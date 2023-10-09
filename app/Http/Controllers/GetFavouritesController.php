<?php

namespace App\Http\Controllers;
namespace App\Exeptions\MySQLExpetion;

class GetFavouritesController extends Controller
{
    public function getFavourited(Request $request)
    {
        $id_user = session()->get('logged_user_id');

        try {
            //create the tables and see if it works!
            $result = DB::table('favourite_restaurants')->select('id_restaurant')->where('id_user', '=', $id_user)->get();
    
            return response()->json($result);
        } catch (MySQLExpetion $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}


?>