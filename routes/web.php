<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'StaticPageController@homepage')->name('welcome');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
     ->namespace('Admin')
     ->name('admin.')
     ->middleware('auth')
     ->group(function(){
    
    Route::get('/', 'HomeController@index')->name('home');

});


// route resource  dishes
Route::resource('dishes', 'Admin\DishController');

// route resource  orders
Route::resource('orders', 'Admin\OrderController');

// route resource  restaurants
Route::resource('restaurants', 'Admin\RestaurantController');
