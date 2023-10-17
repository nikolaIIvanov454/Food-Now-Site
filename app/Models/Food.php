<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Food extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "foods";

    protected $fillable = [
        'name',
        'weight',
        'price',
        'id_restaurant'
    ];
}

?>