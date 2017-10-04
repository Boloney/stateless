<?php

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');



Route::get('filtered-products', 'ProductsController@getList');

Route::get('products/create', 'ProductsController@create')->name('products.create');
Route::get('products/{product}/edit', 'ProductsController@edit')->name('products.edit');
Route::post('products', 'ProductsController@store')->name('products.store');
Route::put('products/{product}', 'ProductsController@update')->name('products.update');
Route::delete('products/{product}', 'ProductsController@destroy')->name('products.delete');

Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
Route::get('categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');
Route::post('categories', 'CategoriesController@store')->name('categories.store');
Route::put('categories/{category}', 'CategoriesController@update')->name('categories.update');
Route::delete('categories/{category}', 'CategoriesController@destroy')->name('categories.delete');

