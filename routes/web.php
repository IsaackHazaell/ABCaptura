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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function(){
  return view('admin.dashboard');
});

//Construction Routes
Route::resource('construction','ConstructionController');
Route::get('showTableC','ConstructionController@showTableC')->name('construction.showTableC');

//Providers rout's
Route::resource('provider','ProviderController');
Route::get('showTableP','ProviderController@showTableP')->name('provider.showTableP');

//Unity Routes
Route::resource('unity','UnityController');
Route::get('showTableU','UnityController@showTableU')->name('unity.showTableU');

//Product Routes
Route::resource('product','ProductController');
Route::get('showTableProduct','ProductController@showTableProduct')->name('product.showTableProduct');
