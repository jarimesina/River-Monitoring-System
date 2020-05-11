<?php

use App\WaterLevel;
use App\Events\WaterLevel as LevelNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

Route::get('/display/{id}', 'SectionsController@test')->name('display');
Route::resource('sections', 'SectionsController');
Route::get('index', 'apiController@index')->name('index');
Route::post('dataRange', 'apiController@index')->name('dataRange');
Route::get('process', 'apiController@process')->name('process');
Route::get('/rivers/{river}/details', 'RiverController@details')->name('details');
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

Route::get('/sample', function(){
	event(new LevelNotification('hello world'));
});

Route::post('/webhook', 'WaterLevelController@store');
Route::get('/rivers/{id}/levels', 'WaterLevelController@getWaterLevel')->name('meta');
Route::get('sections/add/{riverId}', 'SectionsController@add')->name('sections.add');