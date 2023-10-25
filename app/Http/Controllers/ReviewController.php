<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;

class ReviewController extends Controller{
    protected function reviewOperations(Request $request){

        $already_reviwed = Review::all()->where("username", session('logged_username'))->first();

        if(!isset($already_reviwed)){
            $review = new Review();
            $review->stars = $request->input('rating');
            $review->review_description = $request->input('review-description');
            $review->username = session('logged_username');
            $review->id_user = session('logged_user_id');
            $review->id_restaurant = $request->input('id_restaurant');
            $review->save(); 
            
            return response()->json(['message' => 'Успешно добавяне на ревю!'], 200);
        }
        
        if($request->input('action') == 'check'){
            return response()->json(['authorized_user' => session('logged_username')], 200);
        }
        
        if($request->input('action') == 'delete'){
            $already_reviwed->delete();
        }

        return response()->json(['message' => 'Има вече написано ревю от този потребител!'], 200);
    }
}

?>