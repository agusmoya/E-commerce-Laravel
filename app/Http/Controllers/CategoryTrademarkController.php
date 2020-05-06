<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryTrademark;
use App\Category;
use App\Trademark;

class CategoryTrademarkController extends Controller
{
    public function showCategoryTrademark(){

      $arrayCategories = Category::where('status', 1)
      ->orderBy('name')
      ->get();

      $arrayTrademarks = Trademark::where('status', 1)
      ->orderBy('name')
      ->get();

      $alert = 'The relationship you want to enter is already in the system!';

      $arrayCategoryTrademark = CategoryTrademark::join('categories', 'category_id', '=', 'categories.id')
      ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
      ->select('category_trademark.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
      ->where('category_trademark.status', 1)
      ->orderBy('name_trademark')
      ->paginate(4);
      return view('crudCategoryTrademark', compact('arrayCategoryTrademark','arrayCategories', 'arrayTrademarks', 'alert'));
    }

    public function createCategoryTrademark(Request $form){
      $rules = [
        "category_id" => "required",
        "trademark_id" => "required"
      ];

      $messages = [
        "required"=>"You must select an option to create the relationship.",
      ];

      $this->validate($form, $rules, $messages);

      $arrayCategoryTrademark = CategoryTrademark::all();

      foreach ($arrayCategoryTrademark as $row) {
        if ($row['category_id']==$form['category_id']
        && $row['trademark_id']==$form['trademark_id']) {
          return redirect('/productManagment/crudCategoryTrademark')->with('status', 'The relationship you are trying to enter has already been loaded!');
        }
      }

      $newCategoryTrademark = new CategoryTrademark();

      $newCategoryTrademark->category_id = $form["category_id"];
      $newCategoryTrademark->trademark_id = $form["trademark_id"];
      $newCategoryTrademark->save();

      return redirect('/productManagment/crudCategoryTrademark');
    }

    public function deleteCategoryTrademark(Request $form){
      $categoryTrademark = CategoryTrademark::where([
        ['trademark_id', '=', $form["trademark_id"]],
        ['category_id', '=', $form["category_id"]],
      ])->delete();
      return redirect('/productManagment/crudCategoryTrademark');
    }
}
