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
        'id_restaurant',
    ];
}
