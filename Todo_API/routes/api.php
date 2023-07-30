<?php
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('task',[TaskController::class,'index']);
Route::post('task',[TaskController::class,'store']);
Route::get('task/{id}',[TaskController::class,'show']);