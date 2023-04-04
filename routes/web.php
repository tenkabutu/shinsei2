<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OverWorkController;
use App\Http\Controllers\TeleWorkController;
use App\Http\Controllers\ShinseiController;
use App\Http\Controllers\AcceptController;
use App\Http\Controllers\PaidLeaveController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('create_te',[TeleWorkController::class,'create']);
Route::get('{id}/show_te',[TeleWorkController::class,'show_te']);
Route::post('save_te',[TeleWorkController::class,'save']);
Route::post('save_request_te',[TeleWorkController::class,'save_request']);
Route::post('{id}/save_te',[TeleWorkController::class,'save']);
Route::post('{id}/save_request_te',[TeleWorkController::class,'save_request']);
Route::post('{id}/update_te',[TeleWorkController::class,'update']);
Route::post('{id}/update_request_te',[TeleWorkController::class,'update_request']);

Route::get('create_pa',[PaidLeaveController::class,'create']);
Route::get('{id}/show_pa',[PaidLeaveController::class,'show_pa']);
Route::post('{id}/show_pa',[PaidLeaveController::class,'show_pa']);
Route::post('save_pa',[PaidLeaveController::class,'save']);
Route::post('save_request_pa',[PaidLeaveController::class,'save_request']);
Route::post('{id}/save_pa',[PaidLeaveController::class,'save']);
Route::post('{id}/save_request_pa',[PaidLeaveController::class,'save_request']);
Route::post('{id}/update_pa',[PaidLeaveController::class,'update']);
Route::post('{id}/update_request_pa',[PaidLeaveController::class,'update_request']);
Route::post('{id}/delete_pa',[PaidLeaveController::class,'delete']);

Route::post('{id}/accept',[AcceptController::class,'accept']);
Route::post('{id}/redo',[AcceptController::class,'redo']);
Route::post('{id}/reject',[AcceptController::class,'reject']);

Route::get('matter_search',[ShinseiController::class,'matter_search']);
Route::get('matter_ruling',[ShinseiController::class,'matter_ruling']);
Route::get('/',[DashboardController::class,'show_dash']);
Route::get('/dashboard',[DashboardController::class,'show_dash']);

//Route::get('/', function () { return view('dashboard');})->middleware(['auth'])->name('dashboard');

//Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
