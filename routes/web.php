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

Route::resource('construction','ConstructionController');

//Providers rout's
Route::resource('provider','ProviderController');
Route::get('showTable','ProviderController@showTable')->name('provider.showTable');

//Address providers rout's
//Route::resource('address','AddressController');

//UnitPrice's rout's
Route::resource('unitPrice','UnitPriceController');
Route::get('showTable','UnitPriceController@showTable')->name('unitPrice.showTable');
