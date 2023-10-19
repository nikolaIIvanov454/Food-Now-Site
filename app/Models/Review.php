<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'reviews';

    protected $fillabe = [
        'id_review',
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
