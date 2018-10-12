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

use App\Http\Controllers\AuthSocialController;
use App\Http\Controllers\Auth\AuthController;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('auth/callback/{provider}', 'AuthSocialController@handleProviderCallback');
Route::get('auth/redirect/{provider}', 'AuthSocialController@redirectToProvider');