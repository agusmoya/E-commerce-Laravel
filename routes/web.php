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
Route::delete('/productForm/deleteCategoryAndTrademark', 'CategoryTrademarkController@deleteCategoryTrademark');


// Route::get('productForm/showTrademarkCategories','TrademarkController@getTrademarkCategories');

//CARGAR PRODUCTO
Route::post('/productForm/registerProduct', 'ProductController@insertProduct');
// BORRAR PRODUCTO
Route::delete('/productForm/deleteProduct', 'ProductController@deleteProduct');
