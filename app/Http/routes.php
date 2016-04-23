<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */
Route::get ( '/', function () {
	return view ( 'customAuthentication' );
} );
Route::post ( '/login', 'MainController@login' );
Route::post ( '/register', 'MainController@register' );
Route::get ( '/logout', 'MainController@logout' );
