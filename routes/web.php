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
Route::get('showTableFC','FundController@showTableFC')->name('fund.showTableFC');

//Product Routes
Route::resource('product','ProductController');
Route::get('showTableProduct','ProductController@showTableProduct')->name('product.showTableProduct');

//Capture Routes
Route::resource('capture','CaptureController');
Route::get('showTablePC','CaptureController@showTablePC')->name('capture.showTablePC');
Route::get('showTableCa','CaptureController@showTableCa')->name('capture.showTableCa');
Route::post('saveProduct','CaptureController@saveProduct')->name('capture.saveProduct');
Route::post('create2','CaptureController@create2')->name('capture.create2');
Route::delete('deleteTemporalCaptureProduct','CaptureController@deleteTemporalCaptureProduct')->name('capture.deleteTemporalCaptureProduct');

//Honorary Routes
Route::resource('honorary','HonoraryController');
Route::get('showTableHo','HonoraryController@showTableHo')->name('honorary.showTableHo');
Route::get('selectC','HonoraryController@selectC')->name('honorary.selectC');
