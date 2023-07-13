<?php

use App\Http\Controllers\Api\Admin\NewDataController;
use App\Http\Controllers\Api\public\Auth\AuthController;
use App\Http\Controllers\Api\public\BirthdayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["prefix"=>"public"],function() {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);
});

Route::group(['middleware'=> ['check_auth','check_admin'],"prefix" => 'admin'],function (){
    Route::post('store',[NewDataController::class,'store']);
    Route::get('/',[NewDataController::class,'index']);
    Route::get('show/{id}',[NewDataController::class,'show']);
    Route::post('update/{id}',[NewDataController::class,'update']);
    Route::post('delete/{id}',[NewDataController::class,'destroy']);
});

Route::group(['prefix'=> "User",'middleware' =>"check_auth"],function(){
    Route::get("index",[BirthdayController::class,'index']);
});
