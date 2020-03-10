<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $guarded = [];

    public function shoppingCart(){
      return hasOne('App\ShoppingCart');
    }
}
