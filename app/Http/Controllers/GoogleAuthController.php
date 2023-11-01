<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }
    
    
    public function callbackGoogle() {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('social_id', $google_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'name'=>$google_user->getName(),
                    'email'=>$google_user->getEmail(), 
                    'social_id'=>$google_user->getId(),
                    'social_type'=>'google',
                    // 'password'=>bcrypt(generateRandom()),

                ]);

                Auth::login($new_user);
                return response()->json([
                    'message'=>'Welcome In Our Website', 
                    'user'=>auth()->user(),
                ]);
                // new AuthController->login($new_user);
            }else {
                Auth::login($user);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Unauthorized', 
            ]);
            throw $th;
        }
    }

    public function facebookredirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook() {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            dd($facebook_user);
            $user = User::where('social_id', $facebook_user->id)->first();

            if (!$user) {
                $new_user = User::create([
                    'name'=>$facebook_user->name,
                    'email'=>$facebook_user->email, 
                    'social_id'=>$facebook_user->id,
                    'social_type'=>'facebook',
                    // 'password'=>Hash::make($google_user->getPassword()),

                ]);

                Auth::login($new_user);
                return response()->json([
                    'message'=>'Welcome In Our Website', 
                    'user'=>auth()->user(),
                ]);
                // new AuthController->login($new_user);
            }else {
                Auth::login($user);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Unauthorized', 
            ]);
            throw $th;
        }
    }

    public function githubredirect() {
        return Socialite::driver('github')->redirect();
    }
    
    
    public function callbackGithub() {
        try {
            $githubUser= Socialite::driver('github')->user();
            // dd($githubUser);
            $user = User::where('social_id', $githubUser->id)->first();

            if (!$user) {
                $new_user = User::create([
                    'name'=>$githubUser->name,
                    'email'=>$githubUser->email,
                    'social_id'=>$githubUser->id,
                    'social_type'=>'github',
                    // 'password'=>Hash::make($githubUser->token),
                ]);

                Auth::login($new_user);
                return response()->json([
                    'message'=>'Welcome In Our Website', 
                    'user'=>auth()->user(),
                ]);
                    // new AuthController->login($new_user);
            }else {
                    Auth::login($user);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>$th, 
            ]);
            throw $th;
        }
    }



    // twitterredirect
    // callbackTwitter

    public function twitterredirect() {
        return Socialite::driver('twitter')->redirect();
    }
    
    
    public function callbackTwitter() {
        try {
            $twitterUser= Socialite::driver('twitter')->user();
            // dd($githubUser);
            $user = User::where('social_id', $twitterUser->id)->first();

            if (!$user) {
                $new_user = User::create([
                    'name'=>$twitterUser->name,
                    'email'=>$twitterUser->email,
                    'social_id'=>$twitterUser->id,
                    'social_type'=>'twitter',
                    // 'password'=>Hash::make($githubUser->token),
                ]);

                Auth::login($new_user);
                return response()->json([
                    'message'=>'Welcome In Our Website', 
                    'user'=>auth()->user(),
                ]);
                    // new AuthController->login($new_user);
            }else {
                    Auth::login($user);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>$th, 
            ]);
            throw $th;
        }
    }

}
