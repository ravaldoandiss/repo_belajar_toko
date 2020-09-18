<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
   });
   Route::post('/order', 'order@store');
   Route::get('/order', 'order@show');
   Route::get('/order/{id}', 'order@detail');
   Route::delete('/order/{id}', 'order@destroy');

   Route::post('/product', 'product@store');
   Route::get('/product', 'product@show');
   Route::get('/product/{id}', 'product@detail');
   Route::delete('/product/{id}', 'product@destroy');

   Route::get('/customers', 'customers@show');
   Route::get('/customers/{id}', 'customers@detail');
   Route::post('/customers', 'customers@store');
   Route::put('/customers/{id}', 'customers@update');
   Route::delete('/customers/{id}', 'customers@destroy');
