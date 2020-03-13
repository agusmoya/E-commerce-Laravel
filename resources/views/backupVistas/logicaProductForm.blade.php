<?php

// RUTAS PRODUCT FORM TODOJUNTO

// ****************FORMULARIO DE GESTION DE PRODUCTOS todo junto****************
//MOSTRAR MARCAS, CATEGORIAS y PRODUCTOS --- //TAMBIEN MUESTRO LAS CATEGORIAS ASOCIADAS A UNA MARCA
Route::get('/productForm', 'TrademarkController@getTrademarksAndCategoriesAndProducts');
//CARGAR MARCA
Route::post('/productForm/registerTrademark', 'TrademarkController@insertTrademark');
// BORRAR MARCA
Route::delete('/productForm/deleteTrademark', 'TrademarkController@deleteTrademark');

//CARGAR CATEGORIA
Route::post('/productForm/registerCategory', 'CategoryController@insertCategory');
// BORRAR CATEGORIA
Route::delete('/productForm/deleteCategory', 'CategoryController@deleteCategory');

//CARGAR MARCA-CATEGORIA
Route::post('/productForm/registerCategoryAndTrademark', 'CategoryTrademarkController@insertCategoryTrademark');
// BORRAR MARCA-CATEGORIA
Route::delete('/productForm/deleteCategoryTrademark', 'CategoryTrademarkController@deleteCategoryTrademark');

// Route::get('productForm/showTrademarkCategories','TrademarkController@getTrademarkCategories');

//CARGAR PRODUCTO
Route::post('/productForm/registerProduct', 'ProductController@insertProduct');
// BORRAR PRODUCTO
Route::delete('/productForm/deleteProduct', 'ProductController@deleteProduct');
// ****************FIN FORMULARIO DE GESTION DE PRODUCTOS todo junto****************

// RUTAS PRODUCT FORM TODOJUNTO

public function updateTrademark($id){
  $trademark = Trademark::find($id);
  return redirect('/productManagment/crudTrademarks');
}

// ****************FORMULARIO DE GESTION DE PRODUCTOS por separado****************
public function deleteGetTrademark($id){
  $trademark = Trademark::find($id);
  if ($trademark==null) {
    $rules = [
      "id_trademark_delete" => "required"
    ];
    $messages = [
      "required" => "Debe seleccionar una marca para eliminarla!"
    ];
    $this->validate($form, $rules, $messages);
  } else {
    $trademark->status = false;
    $trademark->save();
    return redirect('/productManagment/crudTrademarks');
  }
}

// ****************FORMULARIO DE GESTION DE PRODUCTOS todo junto****************
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
  return redirect('/productManagment/crudTrademarks');
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
// ****************FORMULARIO DE GESTION DE PRODUCTOS todo junto****************

// ****************CONTROLADOR DE CATEGORIAS****************
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
// ****************CONTROLADOR DE CATEGORIAS****************
// ****************CONTROLADOR DE MARCAS/CATEGORIAS****************
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
  $arrayCategoryIdAndTrademarkId=explode(',', $form["trademark_id_category_id"]);
  $trademarkId = $arrayCategoryIdAndTrademarkId[0];
  $categoryId = $arrayCategoryIdAndTrademarkId[1];
  $categoryTrademark = CategoryTrademark::where([
    ['trademark_id', '=', $trademarkId],
    ['category_id', '=', $categoryId],
  ])->delete();

  return redirect('/productForm');
}
// ****************CONTROLADOR DE MARCAS/CATEGORIAS****************
