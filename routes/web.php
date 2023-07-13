<?php

use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\CelebrateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[DataController::class,'main'])->middleware('auth');

Route::group(['prefix' => 'User',"middleware" => ["auth","admin"]],function(){
    Route::get('/',[DataController::class,'index'])->name('all.user');
    Route::get('create',[DataController::class,'create'])->name('create.user');
    Route::post('store',[DataController::class,'store'])->name('store.user');
    Route::post('update/{id}',[DataController::class,'update'])->name('update.user');
    Route::post('delete/{id}',[DataController::class,'destroy'])->name('delete.user');
});



require __DIR__.'/auth.php';
