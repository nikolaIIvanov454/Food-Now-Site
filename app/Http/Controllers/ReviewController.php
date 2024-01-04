<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;

use App\Events\AddReview;
use App\Events\AlreadyReviewed;

class ReviewController extends Controller
{

    protected function reviewOperations(Request $request)
    {

        if($request->input('action') == 'check'){
            return response()->json(['authorized_user' => session('logged_username')], 200);
        }

        if($request->input('id_restaurant')){
            $already_reviwed = Review::all()->where("username", session('logged_username'))->where('id_restaurant',  $request->input('id_restaurant'))->first();
        }

        if($request->input('action') == 'delete'){
            $already_reviwed->delete();
        }

        if(!isset($already_reviwed) && $request->input('id_restaurant')){
            Review::create([
                'username' => session('logged_username'),
                'stars' => $request->input('rating'),
                'review_description' => $request->input('review-description'),
                'id_user' => session('logged_user_id'),
                'id_restaurant' => $request->input('id_restaurant')
            ]);

            broadcast(new AddReview(['message' => 'Успешно добавяне на ревю!']));
        }
        
        if ($request->input('action') != 'delete') {
            broadcast(new AlreadyReviewed(['message' => 'Има вече написано ревю от този потребител!']));
        }
    }
}

?>