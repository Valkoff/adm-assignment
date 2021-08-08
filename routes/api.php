<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('people')->name('people.')->namespace('App\Http\Controllers')->group(static function () {
    Route::get('/', 'PeopleController@index')->name('list');
    Route::get('/{person}', 'PeopleController@show')->name('show');
});
