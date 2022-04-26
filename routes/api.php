<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', 'UserController@user');
    Route::put('like', 'PokemonController@like');
    Route::put('dislike', 'PokemonController@dislike');
    Route::put('favorite', 'PokemonController@favorite');
});