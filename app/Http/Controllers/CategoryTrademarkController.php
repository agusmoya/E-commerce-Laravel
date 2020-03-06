<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryTrademark;
class CategoryTrademarkController extends Controller
{
    public function insertCategoryTrademark(Request $form){

      $newCategoryTrademark = new CategoryTrademark();
      $newCategoryTrademark->category_id = $form["category_id"];
      $newCategoryTrademark->trademark_id = $form["trademark_id"];
      $newCategoryTrademark->save();

      return redirect('/productForm');
    }
}
