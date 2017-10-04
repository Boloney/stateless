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
Route::get('products/{id}/edit', 'ProductsController@edit')->name('products.edit');
Route::post('products', 'ProductsController@store')->name('products.store');
Route::put('products/{id}', 'ProductsController@update')->name('products.update');
Route::delete('products/{id}', 'ProductsController@destroy')->name('products.delete');

Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
Route::get('categories/{id}/edit', 'CategoriesController@edit')->name('categories.edit');
Route::post('categories', 'CategoriesController@store')->name('categories.store');
Route::put('categories/{id}', 'CategoriesController@update')->name('categories.update');
Route::delete('categories/{id}', 'CategoriesController@destroy')->name('categories.delete');

