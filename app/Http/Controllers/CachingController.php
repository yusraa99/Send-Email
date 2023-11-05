<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CachingController extends Controller
{
    public function caching()
    {
        // User::all()
        // Cache::put('CachKey','This should bo Cach', now()->addDay());
        // Cache::forever('key2', 'This is test');
        // Cache::forget('key2');
        // Cache::flush();

        // Redis::set('Users', User::all());

        // for ($i=0; $i < Redis::keys('Users'); $i++) { 
        //     dd(Redis::get('Users'));
        // }
        // dd(Cache::get('CachKey'));
    }


    public function loggingTest(){
        $data=[];
        Log::channel('custom')->info("Hello Testing");
        // info("Hello Testing");
        // return response()->json([
        //     'message'=>'successful',
        // ]);
        return view('welcome', $data);
    }
}
