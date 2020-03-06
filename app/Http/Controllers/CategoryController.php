<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Trademark;
use App\CategoryTrademark;

class CategoryController extends Controller
{
  public function insertCategory(Request $form){
    $rules = [
      "name_category" => "required|alpha|min:3|max:30|unique:categories,name"
    ];

    $messages = [
      "required" => "El campo :attribute no puede estar vacío",
      "alpha" => "El campo :attribute no puede ser numerico",
      "unique" => "El campo :attribute ya ha sido ingresado",
      "min" => "El campo :attribute no puede tener menos de :min caracteres",
      "max" => "El campo :attribute no puede tener mas de :max caracteres"
    ];

    $this->validate($form, $rules, $messages);
    $newCategory = new Category();
    $newCategory->name = $form["name_category"];
    $newCategory->save();
    return redirect('/productForm');
  }

  public function deleteCategory(Request $form){
    $category = Category::find($form["id_category_delete"]);

    if ($category==null) {
      $rules = [
        "id_category_delete" => "required"
      ];
      $messages = [
        "required" => "Debe seleccionar una categoría para eliminarla!"
      ];
      $this->validate($form, $rules, $messages);
    } else {
      $category->delete();
      return redirect('/productForm');
    }
  }

}
