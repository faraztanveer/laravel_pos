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


Route::group(['prefix'=>'admin', 'middleware'=>'auth'],function(){
   
   
Route::get('/', 'adminController@index');
    // Route::get('/products','productsController@index')->name('products');
    // Route::get('/products/create','productsController@create')->name('create-product');
    // Route::get('/products/create/image/{id}','productsController@createProductImages')->name('create-product-images');
Route::resource('products','productsController');
Route::get('product/create/{id}','ProductsController@createImagesPage')->name('addImg');
Route::post('product/storeimages','ProductsController@storeImages');
Route::get('categories','catBrandController@index');
Route::get('/product/delete/{id}', 'productsController@destroy');
Route::get('/product/show/{id}', 'productsController@showProduct');
Route::get('/categories/delete/{id}', 'catBrandController@destroy');
Route::get('/brand/delete/{id}', 'catBrandController@destroyBrand');


// pos routes

Route::get('pos/sales','posController@index');
Route::post('pos/submitSale','posController@submitSale')->name('pos.submitSale');
Route::get('pos/getItemDetail/{id}','posController@getItemDetail');
Route::get('pos/getColors/{id}/{size}','posController@getColors');
Route::get('pos/generateReceipt/{bill}', 'posController@generateReceipt')->name('pos.generateReceipt');
Route::post('/storeCat','catBrandController@storeCat');
Route::post('/storeBrand','catBrandController@storeBrand');
Route::get('/getPropucts','productsController@getProducts')->name('get.products');
});
//Route::post('/addcat','catBrandController@storeCat');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
