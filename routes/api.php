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



Route::prefix('passport')->group(function () {
    Route::get('/', 'PassportController@get');
    Route::post('/{exr}/edit', 'PassportController@update');
    Route::post('/{exr}/delete', 'PassportController@delete');
    Route::post('/create', 'PassportController@create');
});

Route::prefix('charact')->group(function () {
    Route::get('/', 'CharactController@get');
    Route::post('/{exr}/edit', 'CharactController@update');
    Route::post('/{exr}/delete', 'CharactController@delete');
    Route::post('/create', 'CharactController@create');
});

Route::prefix('extractor')->group(function () {
    Route::get('/', 'ExtractorController@get');
    Route::post('/{exr}/edit', 'ExtractorController@update');
    Route::post('/{exr}/delete', 'ExtractorController@delete');
    Route::post('/create', 'ExtractorController@create');
});

Route::prefix('extragent')->group(function () {
    Route::get('/', 'ExtragentController@get');
    Route::post('/{exr}/edit', 'ExtragentController@update');
    Route::post('/{exr}/delete', 'ExtragentController@delete');
    Route::post('/create', 'ExtragentController@create');
});

Route::prefix('heater')->group(function () {
    Route::get('/', 'HeaterController@get');
    Route::post('/{exr}/edit', 'HeaterController@update');
    Route::post('/{exr}/delete', 'HeaterController@delete');
    Route::post('/create', 'HeaterController@create');
});

Route::prefix('source')->group(function () {
    Route::get('/', 'SourceController@get');
    Route::post('/{exr}/edit', 'SourceController@update');
    Route::post('/{exr}/delete', 'SourceController@delete');
    Route::post('/create', 'SourceController@create');
});

Route::prefix('extractor-details')->group(function () {
    Route::get('/', 'ExtractorDetailController@get');
    Route::post('/{exr}/edit', 'ExtractorDetailController@update');
    Route::post('/{exr}/delete', 'ExtractorDetailController@delete');
    Route::post('/create', 'ExtractorDetailController@create');
});


Route::prefix('coolant')->group(function () {
    Route::get('/', 'CoolantController@get');
    Route::post('/{exr}/edit', 'CoolantController@update');
    Route::post('/{exr}/delete', 'CoolantController@delete');
    Route::post('/create', 'CoolantController@create');
});

Route::prefix('detail')->group(function () {
    Route::get('/', 'DetailController@get');
    Route::post('/{exr}/edit', 'DetailController@update');
    Route::post('/{exr}/delete', 'DetailController@delete');
    Route::post('/create', 'DetailController@create');
    Route::get('/{detail}/download', 'DetailController@download');
});


Route::prefix('type')->group(function () {
    Route::get('/', 'TypeOfDetailsController@get');
    Route::post('/{exr}/edit', 'CoolantController@update');
    Route::post('/{exr}/delete', 'CoolantController@delete');
    Route::post('/create', 'CoolantController@create');
});


