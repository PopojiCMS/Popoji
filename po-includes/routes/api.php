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
Route::group(['prefix' => 'v1'], function() {
    Route::get('/', 'Api\ApiController@index');
    Route::get('post', 'Api\PostController@get');
    Route::get('post/related/{id}', 'Api\PostController@related');
    Route::get('post/{id}', 'Api\PostController@show');
    Route::get('category', 'Api\CategoryController@get');
    Route::get('category/{id}', 'Api\CategoryController@show');
    Route::get('comment/{id}', 'Api\CommentController@index');
});
