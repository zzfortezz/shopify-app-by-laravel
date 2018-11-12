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

Route::get('/', [
    'uses' => 'SizeGuideController@index',
    'as' => 'home'
])->middleware(['auth.shop']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth.shop'], function(){

   /* Route::get('/', [
        'uses' => 'SizeGuideController@index',
        'as' => 'data.view'
    ]);*/

    //Create route with name is data.crete, and uses controler SizeGuideController and call to function store
    Route::post('/data/store', [
        'uses' => 'SizeGuideController@store',
        'as' => 'data.store'
    ]);

    Route::get('/data/edit/{id}', [
        'uses' => 'SizeGuideController@edit',
        'as' => 'data.edit'
    ]);

    Route::get('/data/create', [
        'uses' => 'SizeGuideController@create',
        'as' => 'data.create'
    ]);

    Route::get('/data/delete/{id}', [
        'uses' => 'SizeGuideController@destroy',
        'as' => 'data.delete'
    ]);
});

Route::get('/get/size', [
    'uses' => 'SizeGuideController@show'
]);
//Route::post('/data/store', ['uses' => 'SizeGuideController@store ', 'as' => 'data.create']);

//Route::post('/data/store', function () {
////    return view('welcome');
//   return "a";
//})->middleware(['auth.shop']);

