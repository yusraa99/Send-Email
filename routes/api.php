<?php

use App\Http\Controllers\SendMailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sendEmail', [SendMailController::class, 'sendApi']);



Route::group(['middleware'=>['api', 'SetAppLang'], 'prefix'=>'{locale}/auth'], function ($router) {
   Route::post('/register', [AuthController::class, 'register']);
   Route::post('/login', [AuthController::class, 'login']);
   Route::get('/profile', [AuthController::class, 'profile']);
   Route::post('/logout', [AuthController::class, 'logout']);
});