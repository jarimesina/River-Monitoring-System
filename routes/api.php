<?php

use Illuminate\Http\Request;

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
Route::get('chart', 'ChartsApiController@index')->name('api.chart');
Route::get('getFlowRate', 'ChartsApiController@getFlowRate')->name('api.getFlowRate');
Route::get('chartDetails', 'ChartsApiController@getDetails')->name('api.chartDetails');
Route::get('getFields', 'ChartsApiController@getFields')->name('api.getFields');
Route::get('dataRange', 'ChartsApiController@getDataRange')->name('api.getDataRange');

Route::post('process', 'apiController@process')->name('api.process');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
