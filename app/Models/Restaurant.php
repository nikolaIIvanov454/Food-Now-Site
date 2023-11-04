<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    
    protected $table = 'restaurants';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'price',
        'region',
    ];
}

?>