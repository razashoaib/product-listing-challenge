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

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    Route::get('/products', ['uses' => 'ProductController@getProducts']);
    Route::get('/products/{product_id}/videos', ['uses' => 'ProductController@getProductVideoPreview']);
});
