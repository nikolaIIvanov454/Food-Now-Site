<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = "shopping_cart";

    protected $primarykey = ["identifier", "instance"];

    protected $fillable = [
        "content"
    ];

    public static function eraseProductByID($id){
        static::where('identifier', $id)->delete();
    }
}
