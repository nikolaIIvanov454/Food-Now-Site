<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;

    protected $table = "menu";

    protected $primaryKey = 'id_food';

    protected $fillable = [
        'name',
        'weight',
        'price',
        'id_restaurant'
    ];
}

?>