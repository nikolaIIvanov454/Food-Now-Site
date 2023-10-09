<?php

namespace App\Http\Controllers;
namespace App\Exeptions\SQLExpetion;
namespace App\Models\User;

class GetFavouritesController extends Controller
{
    public function getFavourited(Request $request)
    {
        $id_user = session()->get('logged_user_id');

        try {
            //create the tables and see if it works!
            // $result = DB::table('favourite_restaurants')->select('id_restaurant')->where('id_user', '=', $id_user)->get();
            $result = User::all()->select('id_restaurant')->where('id_user', '=', $id_user)->get();
    
            return response()->json($result);
        } catch (SQLExpetion $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}


?>