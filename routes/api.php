<?php

use Illuminate\Http\Request;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function()
{

	Route::group(['middleware' => ['api.superadmin']], function()
	{
	Route::delete('/customers/{id}', 'CustomersController@destroy');
	Route::delete('/product/{id}', 'ProductController@destroy');
	Route::delete('/order/{id}', 'OrderController@destroy');
	Route::delete('/parkir/{id}', 'ParkirController@destroy');
	});
	Route::group(['middleware' => ['api.admin']], function()
	{
	Route::post('/customers', 'CustomersController@store');
	Route::put('/customers/{id}', 'CustomersController@update');

	Route::post('/product', 'ProductController@store');
	Route::put('/product/{id}', 'ProductController@update');

	Route::post('/order', 'OrderController@store');
	Route::put('/order/{id}', 'OrderController@update');

	Route::post('/parkir', 'ParkirController@store');
	Route::put('/parkir/{id}', 'ParkirController@update');
	});

Route::get('/customers', 'CustomersController@show');

Route::get('/product', 'ProductController@show');

Route::get('/order', 'OrderController@show');
Route::get('/order/{id}', 'OrderController@detail');

Route::get('/parkir', 'ParkirController@show');
Route::get('/parkir/{id}', 'ParkirController@detail');


});
