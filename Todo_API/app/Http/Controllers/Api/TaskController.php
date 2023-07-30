<?php

namespace App\Http\Controllers\Api;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    public function index()
    {
        $task= Task::all();
        if($task->count() > 0){
            return response()->json([
                'status'=>1,
                'task'=>$task
            ],200);

        }else{
            return response()->json([
                'status'=>0,
                'task'=>'Invalid API key'
            ],400);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id'=>'required|digits:6',
            'task'=>'required|string|max:191',
            
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'error'=> $validator->messages()
            ],422);
        }
        else{
            $task =Task::create([
                'user_id'=>$request->user_id,
                'task'=>$request->task,
                
                
            ]);
            if($task){
                return response()->json([
                    'status'=>1,
                    'message'=>"Successfully created a task"
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"Invalid API key"
                ],500);
            }
        }
    }
    public function show($id){
        $task=Task::find($id);
        if($task){
            return response()->json([
                'status'=>1,
                'message'=> $task
            ],200);
        }else{
            return response()->json([
                'status'=>0,
                'message'=>"Invalid API key"
            ],404);
        }
    }
}
