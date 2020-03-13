<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('/homeHassen', function () {
  return view('homeHassen');
});

Route::get('/home', function () { //auth
  return view('home');
});

Route::get('/products', function () {
  return view('products');
});

Route::get('/registration', function () { //auth
  return view('registration');
});

Route::get('/register', function () { //auth
  return view('register');
});

Route::get('/myPurchase', function () {
  return view('myPurchase');
});

Route::get('/loginHassen', function () {
  return view('loginHassen');
});

Route::get('/login', function () { //auth
  return view('login');
});

Route::get('/faq', function () {
  return view('faq');
});

// ****************FORMULARIO CRUD TRADEMARKS****************
Route::get('/productManagment/crudTrademarks', 'TrademarkController@showTrademarks');

Route::post('/productManagment/createTrademark', 'TrademarkController@createTrademark');

Route::get('/productManagment/updateTrademark/{id}', 'TrademarkController@showUpdateGetTrademark');

Route::put('/productManagment/updateTrademark', 'TrademarkController@updateTrademark');

Route::delete('/productManagment/deleteTrademark', 'TrademarkController@deleteTrademark');

// ****************FORMULARIO CRUD TRADEMARKS****************

// ****************FORMULARIO CRUD CATEGORIES****************

Route::get('/productManagment/crudCategories', 'CategoryController@showCategories');

Route::post('/productManagment/createCategory', 'CategoryController@createCategory');

Route::get('/productManagment/updateCategory/{id}', 'CategoryController@showUpdateCategory');

Route::put('/productManagment/updateCategory', 'CategoryController@updateCategory');

Route::delete('/productManagment/deleteCategory', 'CategoryController@deleteCategory');
// ****************FORMULARIO CRUD CATEGORIES****************

// ****************FORMULARIO CRUD RELATIONSHIP CATEGORY TRADEMARK****************
Route::get('/productManagment/crudCategoryTrademark', 'CategoryTrademarkController@showCategoryTrademark');

Route::post('/productManagment/createCategoryTrademark', 'CategoryTrademarkController@createCategoryTrademark');

Route::delete('/productManagment/deleteCategoryTrademark', 'CategoryTrademarkController@deleteCategoryTrademark');
// ****************FORMULARIO CRUD RELATIONSHIP CATEGORY TRADEMARK****************

// ****************FORMULARIO CRUD PRODUCTS****************
Route::get('/productManagment/crudProducts', 'ProductController@showProducts');

Route::get('/productManagment/updateProduct/{id}', 'ProductController@showUpdateProduct');

Route::put('/productManagment/updateProduct', 'ProductController@updateProduct');

Route::post('/productManagment/createProduct', 'ProductController@createProduct');

Route::delete('/productManagment/deleteProduct', 'ProductController@deleteProduct');
// ****************FORMULARIO CRUD PRODUCTS****************

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
