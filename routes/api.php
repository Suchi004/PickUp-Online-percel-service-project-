<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'/cart'],function(){
  Route::get('/','API\CartsController@index')->name('carts');
  Route::post('/store','API\CartsController@store')->name('carts.store');
  Route::post('/update/{id}','API\CartsController@update')->name('carts.update');
  Route::post('/delete/{id}','API\CartsController@destroy')->name('carts.delete');
});
