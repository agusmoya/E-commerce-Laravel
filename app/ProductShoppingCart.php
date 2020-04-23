<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductShoppingCart extends Model
{
    public $table = 'product_shoppingCart';
    public $primarykey = ['product_id', 'shoppingCart_id'];
    public $guarded = [];
}
