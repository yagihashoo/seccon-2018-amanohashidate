<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'ChallengeController@index')->name('top');
    Route::get('/challenge/{id}', 'ChallengeController@detail')->name('challenge');
    Route::get('/upload', 'UploadController@index')->name('upload');
    Route::get('/me', 'MeController@index')->name('me');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// This must be open for defense point crawling
Route::get('/unsolved', 'UnsolvedController@index')->name('unsolved');