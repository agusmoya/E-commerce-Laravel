<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    public $table = "shoppingCarts";
    public $guarded =[];

    public function products(){
      return $this->belongsToMany('App\Product', 'product_shoppingcart', 'shoppingCart_id', 'product_id');
    }

    // public function user(){
    //   return $this->belongsTo('App\User');
    // }
    //
    // public function purchase(){
    //   return $this->belongsTo('App\Purchase');
    // }


}
