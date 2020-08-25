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

Route::POST('checkout', 'API\CheckoutController@checkout');
Route::GET('products', 'API\ProductController@all'); // memanggil API product menggunakan method GET
Route::GET('transactions/{id}', 'API\TransactionController@get');