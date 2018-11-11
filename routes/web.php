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
})->middleware(['auth.shop'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' =>['auth.shop']], function(){
    //Create route with name is data.crete, and uses controler SizeGuideController and call to function store
//    Route::post('/data/store', ['uses' => 'SizeGuideController@store ', 'as' => 'data.create']);
});
//Route::post('/data/store', ['uses' => 'SizeGuideController@store ', 'as' => 'data.create']);

Route::post('/data/store', function () {
//    return view('welcome');
   return "a";
})->middleware(['auth.shop']);