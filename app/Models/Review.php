<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillabe = [
        'username',
        'stars',
        'review_description',
        'id_user',
        'id_restaurant'
    ];
    
    protected static function getReviews($id_restaurant){
        return Review::all()->where('id_restaurant', $id_restaurant);
    }
}
