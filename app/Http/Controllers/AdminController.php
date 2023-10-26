<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Validator; 
use Illuminate\Http\Request;
use Cknow\Money\Money;

class AdminController extends Controller
{
    // $users=auth()->user();
    // if ($users->can('do-everything')) {
    //     return response()->json(auth()->user());
    // }

    public function addFund(Request $request) {
        $users=auth()->user();
            if ($users->can('do-everything')) {
                // return response()->json(['user'=>auth()->user()]);
                // $table->string('name');
                // $table->string('description');
                // $table->integer('total_price');
                // $table->integer('min_invest');
                $validator= Validator::make($request->all(),[
                    'name'=> 'required', 
                    'description'=> 'required|string|min:6',
                    'total_price'=> 'required',
                    'min_invest'=> 'required',
                    
                ]);

                // (integer) 
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $project=Project::create(array_merge(
                    $validator->validated(),
                    // ['total_price'=>(float)$request->total_price,],
                    
                ));
                // $price= Money::SAR($project->total_price);
                return response()->json([
                    'message'=>'Project Successfully Created',
                    // 'project'=>$project,
                    [
                        'project_name'=> $project->name,
                        'project_description'=> $project->description,
                        'project_total_price'=>number_format($project->total_price),
                        'project_min_invest'=> $project->min_invest,
                    ],
                    // 'Currency'=>$price->getCurrency(), 
                    'Currency'=>Money::SAR($project->total_price)->getCurrency(),
                ], 200);
            }
        
    }
    
}
