<?php

use App\Events\Hello;
use App\Events\PrivateTest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\GoogleAuthController;

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



Auth::routes();


// Route::group(['middleware'=>'cacheable'], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// });
Route::get('/caching', [App\Http\Controllers\CachingController::class, 'caching']);
Route::get('/loggingTest', [App\Http\Controllers\CachingController::class, 'loggingTest']);



Route::get('/send_emails', [SendMailController::class, 'form'])->name('send_emails_form');
Route::post('/send_emails', [SendMailController::class, 'send_emails'])->name('send_emails');

Route::get('/broadcast', function(){
    Hello::dispatch();
    return 'sent';
});
Route::get('/broadcast-private', function(){
    $users=auth()->user();
    // PrivateTest::dispatch($users);
    broadcast(new PrivateTest($users));
    return 'sent '.$users->email;
    // return 'sent';
});


Route::get('auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('auth/facebook', [GoogleAuthController::class, 'facebookredirect']);
Route::get('auth/facebook/callback', [GoogleAuthController::class, 'callbackFacebook']);

Route::get('auth/github', [GoogleAuthController::class, 'githubredirect']);
Route::get('auth/github/callback', [GoogleAuthController::class, 'callbackGithub']);

Route::get('auth/twitter', [GoogleAuthController::class, 'twitterredirect']);
Route::get('auth/twitter/callback', [GoogleAuthController::class, 'callbackTwitter']);