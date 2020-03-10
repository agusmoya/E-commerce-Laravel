<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
  public $guarded=[];

  public function categories(){
    return $this->belongsToMany('App\Category', 'category_trademark', 'trademark_id', 'category_id');
  }
}
