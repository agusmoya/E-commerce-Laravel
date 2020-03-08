<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryTrademark;

class CategoryTrademarkController extends Controller
{
    public function insertCategoryTrademark(Request $form){

      $rules = [
        "category_id" => "numeric|required",
        "trademark_id" => "numeric|required"
      ];

      $messages = [
        "numerico"=>"El campo :attribute debe ser numerico",
        "unique"=>"El campo :attribute ya se encuentra cargado en el sistema"
      ];

      $this->validate($form, $rules, $messages);

      $newCategoryTrademark = new CategoryTrademark();
      $newCategoryTrademark->category_id = $form["category_id"];
      $newCategoryTrademark->trademark_id = $form["trademark_id"];
      $newCategoryTrademark->save();

      return redirect('/productForm');
    }

    public function deleteCategoryTrademark(Request $form){
      $arrayCategoryIdAndTrademarkId=explode($form["category_trademark_id"]);
      $categoryTrademark = CategoryTrademark::find();



    }
}
