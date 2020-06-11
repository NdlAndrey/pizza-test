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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@dashboard')->name('dashboard');

    // ajax get list pizza
    Route::get('get-pizza', 'PizzaController@getPizza')->name('pizza.get-ajax');

    // resource pages pizza
    Route::resource('pizza', 'PizzaController');
    Route::resource('ingredients', 'IngredientController');
});
