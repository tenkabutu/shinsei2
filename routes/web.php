<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OverWorkController;
use App\Http\Controllers\ShinseiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('user',[UserController::class,'userlist']);
Route::post('user/change',[UserController::class,'user_change']);

Route::get('create_ov',[OverWorkController::class,'create']);
Route::get('{id}/rewrite_ov',[OverWorkController::class,'show_ov']);

Route::post('save_ov',[OverWorkController::class,'save']);
Route::post('save_request_ov',[OverWorkController::class,'save_request']);

Route::post('{id}/save_ov',[OverWorkController::class,'save']);
Route::post('{id}/save_request_ov',[OverWorkController::class,'save_request']);

Route::post('{id}/update_ov',[OverWorkController::class,'update']);
Route::post('{id}/update_request_ov',[OverWorkController::class,'update_request']);

Route::post('{id}/accept_ov',[OverWorkController::class,'accept']);
Route::post('{id}/redo_ov',[OverWorkController::class,'redo']);
Route::post('{id}/reject_ov',[OverWorkController::class,'reject']);

Route::get('matter_search',[ShinseiController::class,'matter_search']);
Route::get('matter_ruling',[ShinseiController::class,'matter_ruling']);

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
