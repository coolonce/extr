<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    // dd(Auth::->user());
    if(Auth::check()){
        return view('welcome');
    }else{
        // dd(Auth::check());
        return redirect('/login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/extragent', 'ExtragentController@index')->name('extragent');
Route::get('/extractor', 'ExtractorController@index')->name('extractor');
Route::get('/heater', 'HeaterController@index')->name('heater');
Route::get('/characts', 'CharactController@index')->name('characts');
Route::get('/source', 'SourceController@index')->name('source');
Route::get('/passport', 'PassportController@index')->name('passport');
Route::get('/coolant', 'CoolantController@index')->name('coolant');
Route::get('/detail', 'DetailController@index')->name('detail');
Route::get('/extractor-details', 'ExtractorDetailController@index')->name('extractor-details');



