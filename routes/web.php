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

//Funds rout's
Route::resource('fund','FundController');
Route::get('showTableF','FundController@showTableF')->name('fund.showTableF');
