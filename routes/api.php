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


Route::middleware(['auth:api'])->group(function () {
    Route::prefix('extragent')->group(function () {
        Route::get('/', 'ExtragentController@get');
    });
    Route::prefix('heater')->group(function () {
        Route::get('/', 'HeaterController@get');
    });

    Route::prefix('source')->group(function () {
        Route::get('/', 'SourceController@get');
    });

    Route::prefix('coolant')->group(function () {
        Route::get('/', 'CoolantController@get');
    });

    Route::prefix('detail')->group(function () {
        Route::get('/', 'DetailController@get');
        Route::get('/{detail}/download', 'DetailController@download');
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});







