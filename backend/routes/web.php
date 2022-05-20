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

Route::get('/', function () {
    return redirect('products.index');
});

Route::resources([
    'products' => 'ProductController',
    'stores' => 'StoreController',
    'users' => 'UserController',
    'roles' => 'RoleController',
]);

Route::prefix('prices')->group(function () {
    Route::get('/', 'PriceController@create')->name('prices.index');
    Route::post('/', 'PriceController@store')->name('prices.store');
    Route::get('/lists', 'PriceController@list')->name('prices.lists');
    Route::post('/lists', 'PriceController@generate')->name('prices.generate');
});


