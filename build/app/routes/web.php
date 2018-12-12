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
    $this->get('/', 'TopController@index')->name('top');
    $this->get('upload', 'UploadController@index')->name('upload');
    $this->get('unsolved', 'TopController@index')->name('unsolved');
    $this->get('me', 'meController@index')->name('me');
});

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');

$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

$this->get('logout', 'Auth\LoginController@logout')->name('logout');
