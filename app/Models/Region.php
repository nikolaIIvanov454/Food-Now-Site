<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Region extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'regions';

    protected $fillable = [
        'id_restaurant_regions',    
        'city',
    ];
}

?>