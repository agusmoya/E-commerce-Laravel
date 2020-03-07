<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trademark;
use App\Category;
use App\Product;
use App\CategoryTrademark;


class TrademarkController extends Controller
{
  public function getTrademarksAndCategoriesAndProducts(Request $form){
    $arrayTrademarks = Trademark::all();
    $arrayCategories = Category::all();
    $arrayProducts = Product::all();

    return view('productForm', compact('arrayTrademarks', 'arrayCategories', 'arrayProducts'));
  }

  public function insertTrademark(Request $form){
    $rules = [
      "name_trademark" => "required|alpha|min:3|max:30|unique:trademarks,name"
    ];

    $messages = [
      "alpha" => "El campo :attribute no puede ser numerico",
      "unique" => "El campo :attribute ya ha sido ingresado",
      "min" => "El campo :attribute no puede tener menos de :min caracteres",
      "max" => "El campo :attribute no puede tener mas de :max caracteres",
      "required" => "El campo :attribute no puede estar vacío"
    ];

    $this->validate($form, $rules, $messages);
    $newTrademark = new Trademark();
    $newTrademark->name = $form["name_trademark"];
    $newTrademark->save();
    return redirect('/productForm');
  }

  public function deleteTrademark(Request $form){
    $trademark = Trademark::find($form["id_trademark_delete"]);
    if ($trademark==null) {
      $rules = [
        "id_trademark_delete" => "required"
      ];
      $messages = [
        "required" => "Debe seleccionar una marca para eliminarla!"
      ];
      $this->validate($form, $rules, $messages);
    } else {
      $trademark->delete();
      return redirect('/productForm');
    }

  }

}
