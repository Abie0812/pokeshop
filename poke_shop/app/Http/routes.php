<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin'], function() {
        Route::get('/', 'AdminController@dashboard');
        Route::group(['prefix'=>'user'], function() {
            Route::get('/', 'UserController@index');
            Route::get('/{id}/getupdate', 'UserController@edit');
            Route::put('/{id}/postupdate', 'UserController@update');
            Route::delete('/{id}/postdelete', 'UserController@destroy');
        });
        Route::group(['prefix'=>'pokemon'], function() {
            Route::get('/', 'PokemonController@index');
            Route::get('/getinsert', 'PokemonController@create');
            Route::post('/postinsert', 'PokemonController@store');
            Route::get('/{id}/getupdate', 'PokemonController@edit');
            Route::post('/{id}/postupdate', 'PokemonController@update');
            Route::delete('/{id}/postdelete', 'PokemonController@destroy');
        });
        Route::group(['prefix' => 'element'], function() {
            Route::get('/', 'ElementController@index');
            Route::get('/getinsert', 'ElementController@create');
            Route::post('/postinsert', 'ElementController@store');
            Route::get('/{id}/getupdate', 'ElementController@edit');
            Route::put('/{id}/postupdate', 'ElementController@update');
            Route::delete('/{id}/postdelete', 'ElementController@destroy');
        });
    });
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile/{id?}', 'HomeController@profile');
    Route::group(['prefix' => 'pokemon'], function() {
        Route::get('/', 'PokemonController@indexpokemon');
        Route::get('/{slug}', 'PokemonController@showpokemon');
        Route::post('/comment/{id}', 'CommentController@store');
        Route::get('/comment/{id}/edit', 'CommentController@edit');
        Route::put('/comment/{id}', 'CommentController@update');
        Route::delete('/comment/{id}', 'CommentController@destroy');
    });
    Route::group(['prefix' => 'shop'], function() {
        // Route::get('/', 'ProductController@getIndex');
        Route::get('/add-to-cart/{id}', 'PokemonController@getAddToCart');          
        Route::get('/shopping-cart', 'PokemonController@getCart');
        Route::get('/checkout', 'PokemonController@getCheckout');
        Route::post('/checkout', 'PokemonController@postCheckout');
    });        
});


Route::auth();

Route::get('/home', 'HomeController@index');
