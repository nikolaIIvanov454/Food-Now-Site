<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantRegion extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $fillabe = [
        'city'
    ];
}
