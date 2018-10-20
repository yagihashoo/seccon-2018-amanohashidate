<?php

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

use Illuminate\Support\Facades\Route;

Route::resource('user', 'Api\UserController', ['only' => ['index', 'show']]);
Route::get('me', 'Api\UserController@me');

Route::resource('challenge', 'Api\ChallengeController', ['only' => ['index', 'show', 'update', 'create']]);
Route::post('challenge/{challenge}/verify', 'Api\ChallengeController@verify');
Route::resource('promotion_request', 'Api\PromotionRequestController', ['only' => ['index', 'show', 'update', 'create']]);