<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use App\Trademark;

class ProductController extends Controller
{
  public function insertProduct(Request $form){
    $rules = [
      "trademarkId_categoryId" => "required",
      "name_product" => "required|alpha|min:3|max:30|unique:categories,name",
      "price" => "required|numeric",
      "description" => "required|string|min:3",
      "stock" => "integer|required",
      "photo" => "required|unique:products,photo|mimes:jpg,jpeg,png"
    ];

    $messages = [
      "required" => "El campo :attribute no puede estar vacío",
      "alpha" => "El campo :attribute no puede ser numerico ni tener espacios en blanco",
      "unique" => "El campo :attribute ya ha sido ingresado",
      "min" => "El campo :attribute no puede tener menos de :min caracteres",
      "max" => "El campo :attribute no puede tener mas de :max caracteres",
      "numeric" => "El campo :attribute debe ser un número",
      "mimes" => "El campo :attribute debe ser de tipo .jpg, .jpeg o .png",
      "string" => "El campo :attribute debe ser texto",
      "integer" => "El campo :attribute debe ser un numero entero",

    ];
    $this->validate($form, $rules, $messages);

    $newProduct = new Product();
    //Del formulario me llega una cadena separada por coma delid de trademark y de category
    $result = explode(',', $form["trademarkId_categoryId"]);
    $newProduct->trademark_id = $result[0];
    $nameTrademark = Trademark::find($newProduct->trademark_id)->name;
    $newProduct->category_id = $result[1];
    $nameCategory = Category::find($newProduct->category_id)->name;
    $newProduct->name = $form["name_product"];
    $newProduct->price = $form["price"];
    $newProduct->description = $form["description"];
    $newProduct->stock = $form["stock"];

    $ruta = $form->file('photo')->store('public/imagenes/imgProductos');
    $nombreArchivo = basename($ruta);
    $newProduct->photo = $nombreArchivo;
    $newProduct->save();
    $productDetail = array("objProduct"=>$newProduct, "nameTrademark"=>$nameTrademark, "nameCategory"=>$nameCategory);
    return view('loadedProductPreview', compact('productDetail'));
  }

  public function deleteProduct(Request $form){
    $product = Product::find($form['product_id']);
    $product -> delete();
    return redirect('/productForm');
  }



}
