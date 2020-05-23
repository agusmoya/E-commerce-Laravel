<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $guarded=[];

    public function shoppingCarts(){
      return $this->belongsToMany('App\ShoppinCart', 'product_shoppingcart', 'product_id', 'shoppingCart_id');
    }

    // public function trademark(){
    //   $this->hasOne('App\Trademark');
    // }
    //
    // public function category(){
    //   $this->hasOne('App\Category');
    // }

}
