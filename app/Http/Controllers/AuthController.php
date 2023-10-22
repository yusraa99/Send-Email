<?php

namespace App\Http\Controllers;
use Auth;
use Validator; 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;

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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user=User::create(array_merge(
            $validator->validated(),
            ['password'=>bcrypt($request->password)]
        ));
        return response()->json([
            'message'=>'user successfully registered',
            'user'=>$user, 
        ], 200);

    }
    
    public function login(Request $request) {
        $validator= Validator::make($request->all(),[
            'email'=> 'required|email', 
            'password'=> 'required|string|min:6', 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!$token=auth()->attempt($validator->validated())){
            return response()->json(['error'=>'Unauthorized', ], 401);

        }
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
        return response()->json(['user'=>auth()->user()],200);

    }
    
    public function logout(){

        auth()->logout();

        return response()->json([
            'message'=>'user successfully logged out'
        ]);
    }
}
