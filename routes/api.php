<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('product', 'ProductController@create');
Route::get('product/{id}', 'ProductController@read');
Route::patch('product/{id}', 'ProductController@update');
Route::delete('product/{id}', 'ProductController@delete');

Route::post('lineItem', 'LineItemController@create');
Route::get('lineItem/{id}', 'ProductController@read');
Route::patch('lineItem/{id}', 'ProductController@update');
Route::delete('lineItem/{id}', 'ProductController@delete');

Route::post('shop', 'ShopController@create');
Route::get('shop/{id}', 'ShopController@read');
Route::patch('shop/{id}', 'ShopController@update');
Route::delete('shop{id}', 'ShopController@delete');

Route::post('order', 'OrderController@create');
Route::get('order/{id}', 'OrderController@read');
Route::patch('order/update/{id}', 'OrderController@updateOrderTotal');
Route::patch('order/{id}', 'OrderController@update');