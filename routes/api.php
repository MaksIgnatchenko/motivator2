<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthSocialController;

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

Route::post('login/{service}', 'AuthSocialController@loginSocial')->where(['service' => '^(facebook|twitter)$']);
Route::get('refresh', 'AuthSocialController@refresh');