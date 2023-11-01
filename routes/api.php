<?php

use App\Events\Hello;
use App\Events\PrivateTest;
use App\Http\Controllers\SendMailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Spatie\Permission\Contracts\Role;

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
   Route::post('/invest', [AuthController::class, 'invest']);
   Route::post('/logout', [AuthController::class, 'logout']);
   Route::get('auth/google', [GoogleAuthController::class, 'redirect']);
   Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);
});

Route::group(['middleware'=>['api','can:do-everything', 'SetAppLang'], 'prefix'=>'{locale}/auth/admin'], function ($router) {
    Route::post('/addFund', [AdminController::class, 'addFund']);
    // Route::post('/login', [AuthController::class, 'login']);
    // Route::get('/profile', [AuthController::class, 'profile']);
 });

//  Route::get('/broadcast', function(){
//     Hello::dispatch(); 
//     return 'sent';});
Route::group(['middleware'=>['api', 'SetAppLang'], 'prefix'=>'{locale}/broadcasting'], function ($router) {
    Route::get('/broadcast', function(){
        // Hello::dispatch();
        broadcast(new Hello()); 
        return 'sent';});
    Route::get('/broadcast-private', function(){
        // $user=User::
        // Hello::dispatch(); 
        $users=auth()->user();
        // PrivateTest::dispatch($users);
        broadcast(new PrivateTest($users));
        return 'sent '.$users->email;});
    // Route::post('/login', [AuthController::class, 'login']);
    // Route::get('/profile', [AuthController::class, 'profile']);
 });


 Route::group(['middleware'=>['api', 'SetAppLang'], 'prefix'=>'{local}/cach'], function(){
    Route::get('/home', [HomeController::class, 'apiindex']);

 });