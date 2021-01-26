<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('products', 'ProductController@index');
    Route::post('products/delete', 'ProductController@destroy');
    Route::post('products/store', 'ProductController@store');
    Route::post('products/update', 'ProductController@update');

});
