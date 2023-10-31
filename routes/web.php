<?php

use App\Events\Hello;
use App\Events\PrivateTest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendMailController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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