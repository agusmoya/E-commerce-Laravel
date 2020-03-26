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

Route::get('/probandoJS', function () {
  return view('probandoJS');
});

Route::get('/homeHassen', function () {
  return view('homeHassen');
});

// Route::get('/home', function () { //auth
//   return view('home');
// });

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', function () {
  return view('products');
});

Route::get('/registration', function () {
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

Route::get('/homeHassen', 'HomeController@index')->name('homeHassen');

Route::get('/homeHassen/availableProducts', 'ProductController@availableProducts');

// ****************FORMULARIO USER****************

// Route::get('/userProfile', 'HomeController@showUserProfile');
Route::get('/userProfile', function(){
  return view('userProfile');
});
Route::get('/userProfile/updateUserProfile/{id}', 'UserHassenController@showUpdateUserProfile');

Route::post('/userProfile/updateUserProfile', 'UserHassenController@updateUserProfile');

// ****************FORMULARIO USER****************

// ****************FORMULARIO CRUD TRADEMARKS****************
Route::get('/productManagment/crudTrademarks', 'TrademarkController@showTrademarks')->middleware('roleUser');

Route::post('/productManagment/createTrademark', 'TrademarkController@createTrademark');

Route::get('/productManagment/updateTrademark/{id}', 'TrademarkController@showUpdateGetTrademark')->middleware('roleUser');

Route::put('/productManagment/updateTrademark', 'TrademarkController@updateTrademark');

Route::delete('/productManagment/deleteTrademark', 'TrademarkController@deleteTrademark');
// ****************FORMULARIO CRUD TRADEMARKS****************

// ****************FORMULARIO CRUD CATEGORIES****************
Route::get('/productManagment/crudCategories', 'CategoryController@showCategories')->middleware('roleUser');

Route::post('/productManagment/createCategory', 'CategoryController@createCategory');

Route::get('/productManagment/updateCategory/{id}', 'CategoryController@showUpdateCategory')->middleware('roleUser');

Route::put('/productManagment/updateCategory', 'CategoryController@updateCategory');

Route::delete('/productManagment/deleteCategory', 'CategoryController@deleteCategory');
// ****************FORMULARIO CRUD CATEGORIES****************

// ****************FORMULARIO CRUD RELATIONSHIP CATEGORY TRADEMARK****************
Route::get('/productManagment/crudCategoryTrademark', 'CategoryTrademarkController@showCategoryTrademark')->middleware('roleUser');

Route::post('/productManagment/createCategoryTrademark', 'CategoryTrademarkController@createCategoryTrademark');

Route::delete('/productManagment/deleteCategoryTrademark', 'CategoryTrademarkController@deleteCategoryTrademark');
// ****************FORMULARIO CRUD RELATIONSHIP CATEGORY TRADEMARK****************

// ****************FORMULARIO CRUD PRODUCTS****************
Route::get('/productManagment/crudProducts', 'ProductController@showProducts')->middleware('roleUser');

Route::get('/productManagment/updateProduct/{id}', 'ProductController@showUpdateProduct')->middleware('roleUser');

Route::put('/productManagment/updateProduct', 'ProductController@updateProduct');

Route::post('/productManagment/createProduct', 'ProductController@createProduct');

Route::delete('/productManagment/deleteProduct', 'ProductController@deleteProduct');
// ****************FORMULARIO CRUD PRODUCTS****************

Route::get('/productPreview/{productId}', 'ProductController@showProductPreview');



// ****************Generados con makeauth****************
// Auth::routes(); Lo que figura debajo reemplaza esta línea
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
