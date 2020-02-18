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

// Route::post('dateRange', 'apiController@index')->name('api.dateRange');
// Route::get('dataRange', 'apiController@index')->name('dataRange');
Route::post('dataRange', 'apiController@index')->name('dataRange');
Route::get('process', 'apiController@process')->name('process');
// Route::post('process', 'apiController@process')->name('process');
Route::get('/rivers/{river}/details', 'RiverController@details');
Route::resource('rivers', 'RiverController');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Route::group(['middleware'=>['preventbackbutton']], function(){
//     Auth::routes();
//     Route::get('/home', 'HomeController@index')->name('home');
// });