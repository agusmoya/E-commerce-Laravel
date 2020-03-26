<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{

  public function showCategories(){
    $arrayCategories = Category::where('status', 1)
    ->orderBy('name')
    ->paginate(4);
    return view('crudCategories', compact('arrayCategories'));
  }

  public function showUpdateCategory($id){
    $category = Category::find($id);
    return view('updateCategory', compact('category'));
  }

  public function createCategory(Request $form){
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

    $arrayCategories = Category::all();
    $foundCategory = null;
    foreach ($arrayCategories as $category) {
      if($category["name"] == $form["name_category"]){
        $foundCategory = $category;
        break;
      }
    }

    if(isset($foundCategory)) {
      $foundCategory->status = true;
      $foundCategory->save();
      return redirect('/productManagment/crudCategories');
    } else {
      $this->validate($form, $rules, $messages);
      $newCategory = new Category();
      $newCategory->name = $form["name_category"];
      $newCategory->save();
      return redirect('/productManagment/crudCategories');
    }
  }

  public function updateCategory(Request $form){
    $category = Category::find($form["category_id"]);
    $category->name = $form["name_category"];
    $category->save();
    return redirect('/productManagment/crudCategories');
  }

  public function deleteCategory(Request $form){
    $category = Category::find($form["category_id"]);
    if ($category==null) {
      $rules = [
        "category_id" => "required"
      ];
      $messages = [
        "required" => "Debe seleccionar una categoría para eliminarla!"
      ];
      $this->validate($form, $rules, $messages);
    } else {
      $category->status = 0;
      $category->save();
      return redirect('/productManagment/crudCategories');
    }
  }

}
