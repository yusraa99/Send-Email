<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Dashboard(Request $request){
        return response()->json([
            'message'=>'admin dashboard',
        ], 200);

    }
}
