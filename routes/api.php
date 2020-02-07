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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *  API
 */
Route::group(['prefix' => 'city'], function () {
    Route::get('province', 'API\CityController@getProvince')->name('api.province');
    Route::get('district', 'API\CityController@getDistrict')->name('api.district');
    Route::get('subdistrict', 'API\CityController@getSubdistrict')->name('api.subdistrict');
    Route::get('zipcode', 'API\CityController@getZipcode')->name('api.zipcode');
});
