<?php

namespace App\Http\Controllers;
use Auth;
use Validator; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Permission;
use App\Enums\UserStatus;
class AuthController extends Controller
{

    public function __construct()
    {
        $this-> middleware('auth:api', ['except'=>['login', 'register']]);
    }

    public function register(Request $request) {
        $validator= Validator::make($request->all(),[
            'name'=> 'required', 
            'email'=> 'required|string|email|unique:users', 
            'password'=> 'required|string|confirmed|min:6', 
        ]);
        $Message=[
            'title'=> 'Welcome Our Customer',
            'body'=> 'New Register',
        ];
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user=User::create(array_merge(
            $validator->validated(),
            ['password'=>bcrypt($request->password),
            'status'=> UserStatus::Pending,],
            
        ))->assignRole('user');
        $user->notify(new WelcomeNotification($Message));
        // Notification::send($request->email, new WelcomeNotification($Message));
        return response()->json([
            'message'=>'user successfully registered',
            'user'=>$user, 
        ], 200);

    }
    
    public function login(Request $request) {
        $Message=[
            'title'=> 'Welcome',
            'body'=> 'Hello',
        ];
        $validator= Validator::make($request->all(),[
            'email'=> 'required|email', 
            'password'=> 'required|string|min:6',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!$token=auth()->attempt($validator->validated())){
            return response()->json(['error'=>__('auth.Unauthorized') ], 401);

        }
        // Notification::send($request->email, new WelcomeNotification( $Message));
        $users=auth()->user();
        
        $users->update([
            'status'=> UserStatus::Active, 
        ]);
        $users->notify(new WelcomeNotification($Message));
        
        return $this->createNewToken($token);        
    }

    public function createNewToken($token) {
        return response()->json([
            'access_token'=> $token,
            'token_type'=> 'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60,
            'user'=> auth()->user(),

        ]);
    }

    public function profile(){
        $user=auth()->user();
        return response()->json(['user'=>auth()->user(), $user->getPermissionsViaRoles()],200);

    }
    
    public function logout(){

        auth()->logout();

        return response()->json([
            'message'=>__('auth.Logout')
        ]);
    }
}
