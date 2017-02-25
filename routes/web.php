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
    return view('shop/create');
});

Route::resource('shop', 'ShopController', ['only' => 'create']);

Route::post('shop/uploadImage', [
    'as' => 'shop.uploadImage',
    'uses' => 'ShopController@postUploadImage'
]);

Route::post('shop/addShopAjax', [
    'as' => 'shop.addShopAjax',
    'uses' => 'ShopController@postAddShopAjax'
]);

Route::resource('product', 'ProductController', ['only' => 'create']);

Route::post('product/uploadImage', [
    'as' => 'product.uploadImage',
    'uses' => 'ProductController@postUploadImage'
]);

Route::post('product/addProductAjax', [
    'as' => 'product.addproductAjax',
    'uses' => 'ProductController@postAddProductAjax'
]);
