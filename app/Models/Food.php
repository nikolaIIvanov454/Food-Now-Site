<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = "menu";

    protected $fillable = [
        'name',
        'weight',
        'price',
        'id_restaurant'
    ];
}

?>