<?php

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
    return view('welcome');
});


Route::prefix('companies')->group(function () {

    Route::get('','CompanyController@index')->name('company.index');
    Route::get('search','CompanyController@search')->name('company.search');



});


Route::prefix('types')->group(function () {

    Route::get('','TypeController@index')->name('type.index');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
