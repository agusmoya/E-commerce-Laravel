<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Trademark;
use App\Category;

class ProductController extends Controller
{

  public function showProductPreview($productId){
    $product = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where([
      ['products.status', 1], 
      ['products.id', $productId] 
      ])->get();
      // dd($product);
    return view('loadedProductPreview', compact('product'));

  }

  public function showProducts(){

    $arrayProducts = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where('products.status', 1)
    ->get();

    $arrayTrademarks = Trademark::where('status', 1)->orderBy('name')->get();
    $arrayCategories = Category::where('status', 1)->orderBy('name')->get();
    return view('crudProducts', compact('arrayProducts', 'arrayTrademarks', 'arrayCategories'));
  }

  public function showUpdateProduct($id){
    $product = Product::find($id);
    return view('updateProduct', compact('product'));

  }

  public function createProduct(Request $form){
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

    $arrayProducts = Product::all();
    $result = explode(',', $form["trademarkId_categoryId"]);
    $trademark_id = $result[0];
    $category_id = $result[1];
    $foundProduct = null;
    foreach ($arrayProducts as $product) {
      if($product["name"] == $form["name_product"] && $product["category_id"] == $category_id && $product["trademark_id"] == $trademark_id && $product["status"] == false){
        $foundProduct = $product;
        break;
      }
    }

    if(isset($foundProduct)) {
      $foundProduct->status = true;
      $foundProduct->name = $form["name_product"];
      $foundProduct->price = $form["price"];
      $foundProduct->description = $form["description"];
      $foundProduct->stock = $form["stock"];
      $foundProduct->save();
      return redirect('/productManagment/crudProducts');
    } else {
      $this->validate($form, $rules, $messages);
      $newProduct = new Product();
      //Del formulario me llega una cadena separada por coma del id de trademark y de category
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
  }

  public function updateProduct(Request $form){

    $rules = [
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

    $product = Product::find($form["product_id"]);

    $nameTrademark = Trademark::find($product->trademark_id)->name;
    $nameCategory = Category::find($product->category_id)->name;

    $product->name = $form["name_product"];
    $product->price = $form["price"];
    $product->description = $form["description"];
    $product->stock = $form["stock"];
    $ruta = $form->file('photo')->store('public/imagenes/imgProductos');
    $nombreArchivo = basename($ruta);
    $product->photo = $nombreArchivo;
    $product->save();
    $productDetail = array("objProduct"=>$product, "nameTrademark"=>$nameTrademark, "nameCategory"=>$nameCategory);
    return view('loadedProductPreview', compact('productDetail'));
  }

  public function deleteProduct(Request $form){
    $product = Product::find($form['product_id']);
    $product->status = 0;
    $product->save();
    return redirect('/productManagment/crudProducts');
  }



}
