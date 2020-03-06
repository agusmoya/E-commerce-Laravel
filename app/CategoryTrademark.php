<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTrademark extends Model
{
    public $table = 'category_trademark';
    public $primarykey = ['category_id', 'trademark_id'];
    public $guarded = [];
}
