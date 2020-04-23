<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Trademark;
use App\Category;
use App\CategoryTrademark;

class ProductController extends Controller
{

    public function availableCategory($category){
      $arrayProductsByCategory = Product::join('categories', 'category_id', '=', 'categories.id')
      ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
      ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
      ->where('products.status', 1)
      ->where('trademarks.status', 1)
      ->where('categories.status', 1)
      ->where('categories.name', $category)
      ->orderBy('name_trademark')
      ->orderBy('name_category')
      ->get();

      return view('availableCategory', compact('arrayProductsByCategory'));
    }

  public function availableProducts(){
    $arrayProducts = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where('products.status', 1)
    ->where('trademarks.status', 1)
    ->where('categories.status', 1)
    ->orderBy('name_trademark')
    ->orderBy('name_category')
    ->get();

    $arrayCategories = Category::orderBy('name')->get();
    return view('availableProducts', compact('arrayProducts', 'arrayCategories'));
  }

  public function availableProductsOrder($order){
// Request $form
$form["order"]=$order;
    if ($form["order"] == 1) {
      $order = 'price';
      $cond = 'ASC';
    } elseif ($form["order"] == 2) {
      $order = 'price';
      $cond = 'DESC';
    } elseif ($form["order"] == 3) {
      $order = 'name';
      $cond = 'ASC';
    } elseif ($form["order"] == 4) {
      $order = 'name';
      $cond = 'DESC';
    } elseif ($form["order"] == 5) {
      $order = 'created_at';
      $cond = 'ASC';
    } else {
      $order = 'created_at';
      $cond = 'DESC';
    }

    $arrayProducts = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where('products.status', 1)
    ->where('trademarks.status', 1)
    ->where('categories.status', 1)
    ->orderBy($order, $cond)
    ->orderBy('name_trademark')
    ->orderBy('name_category')
    ->get();

    $arrayCategories = Category::orderBy('name')->get();
    return view('availableProducts', compact('arrayProducts', 'arrayCategories'));
  }

  public function showProductPreview($productId){
    $productForShow = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where([
      ['products.status', 1],
      ['products.id', $productId]
      ])->first();
    return view('loadedProductPreview', compact('productForShow'));

  }

  public function showProducts(){
    $arrayProducts = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where('products.status', 1)
    ->orderBy('name_trademark')
    ->paginate(4);

    $arrayCategoryTrademark = CategoryTrademark::all();
    // dd($arrayCategoryTrademark);
    $arrayTrademarks = Trademark::where('status', 1)->orderBy('name')->get();
    $arrayCategories = Category::where('status', 1)->orderBy('name')->get();
    return view('crudProducts', compact('arrayProducts', 'arrayTrademarks', 'arrayCategories', 'arrayCategoryTrademark'));
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
    //Del formulario me llega una cadena separada por coma del id de trademark y de category
    $result = explode(',', $form["trademarkId_categoryId"]);
    $trademarkId = $result[0];
    $categoryId = $result[1];
    $foundProduct = null;
    foreach ($arrayProducts as $product) {
      if($product["name"] == $form["name_product"] && $product["category_id"] == $categoryId && $product["trademark_id"] == $trademarkId && $product["status"] == false){
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

      $ruta = $form->file('photo')->store('public/imagenes/imgProductos');
      $nombreArchivo = basename($ruta);
      $foundProduct->photo = $nombreArchivo;
      $foundProduct->save();
      $productPreview = $foundProduct;

    } else {
      $this->validate($form, $rules, $messages);
      $newProduct = new Product();
      $newProduct->trademark_id = $trademarkId;
      $newProduct->category_id = $categoryId;
      $newProduct->name = $form["name_product"];
      $newProduct->price = $form["price"];
      $newProduct->description = $form["description"];
      $newProduct->stock = $form["stock"];

      $ruta = $form->file('photo')->store('public/imagenes/imgProductos');
      $nombreArchivo = basename($ruta);
      $newProduct->photo = $nombreArchivo;
      $newProduct->save();

      $productPreview = $newProduct;
    }

    $productForShow = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where([
      ['products.status', 1],
      ['products.id', $productPreview->id]
      ])
    ->first();
    return view('loadedProductPreview', compact('productForShow'));
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

    $productForShow = Product::join('categories', 'category_id', '=', 'categories.id')
    ->join('trademarks', 'trademark_id', '=', 'trademarks.id')
    ->select('products.*', 'categories.name as name_category', 'trademarks.name as name_trademark')
    ->where([
      ['products.status', 1],
      ['products.id', $product->id]
      ])
    ->first();
    return view('loadedProductPreview', compact('productForShow'));
  }

  public function deleteProduct(Request $form){
    $product = Product::find($form['product_id']);
    $product->status = 0;
    $product->save();
    return redirect('/productManagment/crudProducts');
  }

}
