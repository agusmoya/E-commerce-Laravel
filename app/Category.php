<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public $guarded=[];

  public function trademarks(){
    return $this->belongsToMany('App\Trademark', 'category_trademark', 'category_id', 'trademark_id');
  }
}
