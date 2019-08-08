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
})->middleware('auth');

//Clients routes
Route::resource('client','ClientController')->middleware('auth');
Route::get('showTableCl','ClientController@showTableCl')->name('client.showTableCl')->middleware('auth');
Route::get('showTableCC','ClientController@showTableCC')->name('client.showTableCC')->middleware('auth');
//Construction Routes
Route::resource('construction','ConstructionController')->middleware('auth');
Route::get('showTableC','ConstructionController@showTableC')->name('construction.showTableC')->middleware('auth');

//Providers rout's
Route::resource('provider','ProviderController')->middleware('auth');
Route::get('showTableP','ProviderController@showTableP')->name('provider.showTableP')->middleware('auth');

//Funds rout's
Route::resource('fund','FundController')->middleware('auth');
Route::get('showTableF','FundController@showTableF')->name('fund.showTableF')->middleware('auth');
Route::get('showTableFC','FundController@showTableFC')->name('fund.showTableFC')->middleware('auth');

//Product Routes
Route::resource('product','ProductController')->middleware('auth');
Route::get('showTableProduct','ProductController@showTableProduct')->name('product.showTableProduct')->middleware('auth');

//Capture Routes
Route::get('download/{id}', 'CaptureController@download' )->name('capture.download')->middleware('auth');
Route::get('show_storage/{id}', 'CaptureController@show_storage' )->name('capture.show_storage')->middleware('auth');
Route::resource('capture','CaptureController')->middleware('auth');
Route::get('showTablePCshow','CaptureController@showTablePCshow')->name('capture.showTablePCshow')->middleware('auth');
Route::get('showTablePC','CaptureController@showTablePC')->name('capture.showTablePC')->middleware('auth');
Route::get('showTableCa','CaptureController@showTableCa')->name('capture.showTableCa')->middleware('auth');
Route::post('saveProduct','CaptureController@saveProduct')->name('capture.saveProduct')->middleware('auth');
Route::post('create2','CaptureController@create2')->name('capture.create2')->middleware('auth');
Route::delete('deleteTemporalCaptureProduct','CaptureController@deleteTemporalCaptureProduct')->name('capture.deleteTemporalCaptureProduct')->middleware('auth');
Route::post('editProducts','CaptureController@editProducts')->name('capture.editProducts')->middleware('auth');


//Honorary Routes
Route::resource('honorary','HonoraryController')->middleware('auth');
Route::get('showTableHo','HonoraryController@showTableHo')->name('honorary.showTableHo')->middleware('auth');
Route::get('selectC','HonoraryController@selectC')->name('honorary.selectC')->middleware('auth');

//Memory Routes
Route::post('generate-pdf','MemoryController@generatePDF')->name('memory.pdf')->middleware('auth');
Route::resource('memory', 'MemoryController', ['only' => [
    'index', 'show'
]])->middleware('auth');
Route::get('showTableM','MemoryController@showTableM')->name('memory.showTableM')->middleware('auth');
Route::get('showTableMH','MemoryController@showTableMH')->name('memory.showTableMH')->middleware('auth');
Route::get('selectCM','MemoryController@selectCM')->name('memory.selectCM')->middleware('auth');
Route::post('viewClient','MemoryController@viewClient')->name('memory.viewClient')->middleware('auth');

//Statements Routes
Route::resource('statement','StatementController')->middleware('auth');
Route::get('showTableSt','StatementController@showTableSt')->name('statement.showTableSt')->middleware('auth');
Route::get('showTableSC','StatementController@showTableSC')->name('statement.showTableSC')->middleware('auth');
Route::get('showTableProvMat','StatementController@showTableProvMat')->name('statement.showTableProvMat')->middleware('auth');
//Statements Materials Routes
Route::resource('statementMaterial','StatementMaterialController')->middleware('auth');

//Users Routes
Route::resource('user','UserController')->middleware('auth');
Route::get('showTableU','UserController@showTableU')->name('user.showTableU')->middleware('auth');
