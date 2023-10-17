<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Restaurant extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'restaurants';

    protected $fillable = [
        'id_restaurant',
        'name',
        'image_path',
        'description',
        'price',
        'region'
    ];
}

?>