<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Restaurant extends Model{
    protected $connection = 'mongodb';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'price',
        'region'
    ];
}

?>