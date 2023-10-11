<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class LikedRestaurant extends Model{
    protected $connection = 'mongodb';
    protected $collection = 'user_favourites';

    protected $fillable = [
        'id_user',
        'id_restaurant',
    ];
}




?>