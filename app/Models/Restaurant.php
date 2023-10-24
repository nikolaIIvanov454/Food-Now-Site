<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Models\Food;
use Models\Review;

class Restaurant extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'restaurants';

    protected $fillable = [
        '_id',
        'name',
        'image_path',
        'description',
        'price',
        'region',
        'foods'
    ];
}

?>