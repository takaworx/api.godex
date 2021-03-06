<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', 'UserController@user');
    Route::get('user/{id}', 'UserController@findUser');
    Route::put('user', 'UserController@update');
    Route::get('users', 'UserController@paginate');
    
    Route::post('logout', 'UserController@logout');

    Route::put('like', 'PokemonController@like');
    Route::put('dislike', 'PokemonController@dislike');
    Route::put('favorite', 'PokemonController@favorite');
});