<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;


class ProductController extends Controller
{
  public function getCategoriesOfTrademark(Request $form){

    $categoriesOfTrademark = Category::where();

  }

  public function insertProduct(Request $form){
    $rules = [
      "category_id" => "required",
      "trademark_id" => "required|unique:products,photo",
      "name_product" => "required|alpha|min:3|max:30|unique:categories,name",
      "price" => "required|numeric|unique:products,photo",
      "photo" => "required|unique:products,photo"
    ];

    $messages = [
      "required" => "El campo :attribute no puede estar vacío",
      "alpha" => "El campo :attribute no puede ser numerico ni tener espacios en blanco",
      "unique" => "El campo :attribute ya ha sido ingresado",
      "min" => "El campo :attribute no puede tener menos de :min caracteres",
      "max" => "El campo :attribute no puede tener mas de :max caracteres",
      "numeric" => "El campo :attribute debe ser un número"
    ];
    $this->validate($form, $rules, $messages);

    $newProduct = new Product();
    $newProduct->category_id = $form["category_id"];
    $newProduct->trademark_id = $form["trademark_id"];
    $newProduct->name = $form["name_product"];
    $newProduct->price = $form["price"];
    $newProduct->photo = $form["photo"];



    $newProduct->save();

    return redirect('/productForm');

  }

}
