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
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MatterTotalController;

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
Route::post('{id}/fix_ov',[OverWorkController::class,'fix']);
Route::post('{id}/update_request_ov',[OverWorkController::class,'update_request']);
Route::post('{id}/delete_ov',[OverWorkController::class,'delete']);

Route::get('create_te',[TeleWorkController::class,'create']);
Route::get('{id}/show_te',[TeleWorkController::class,'show_te']);
Route::post('save_te',[TeleWorkController::class,'save']);
Route::post('save_request_te',[TeleWorkController::class,'save_request']);
Route::post('{id}/save_te',[TeleWorkController::class,'save']);
Route::post('{id}/save_request_te',[TeleWorkController::class,'save_request']);
Route::post('{id}/update_te',[TeleWorkController::class,'update']);
Route::post('{id}/fix_te',[TeleWorkController::class,'fix']);
Route::post('{id}/update_request_te',[TeleWorkController::class,'update_request']);
Route::post('{id}/delete_te',[TeleWorkController::class,'delete']);

Route::get('create_pa',[PaidLeaveController::class,'create']);
Route::get('{id}/show_pa',[PaidLeaveController::class,'show_pa']);
Route::post('{id}/show_pa',[PaidLeaveController::class,'show_pa']);
Route::post('save_pa',[PaidLeaveController::class,'save']);
Route::post('save_request_pa',[PaidLeaveController::class,'save_request']);
Route::post('{id}/save_pa',[PaidLeaveController::class,'save']);
Route::post('{id}/save_request_pa',[PaidLeaveController::class,'save_request']);
Route::post('{id}/update_pa',[PaidLeaveController::class,'update']);
Route::post('{id}/fix_pa',[PaidLeaveController::class,'fix']);
Route::post('{id}/update_request_pa',[PaidLeaveController::class,'update_request']);
Route::post('{id}/delete_pa',[PaidLeaveController::class,'delete']);

Route::get('create_pu',[PurchaseController::class,'create']);
Route::get('{id}/show_pu',[PurchaseController::class,'show_pu']);
Route::post('{id}/show_pu',[PurchaseController::class,'show_pu']);
Route::post('save_request_pu',[PurchaseController::class,'save_request']);
Route::post('{id}/purcher_accept',[PurchaseController::class,'purcher_accept']);
Route::post('{id}/save_pu',[PurchaseController::class,'save']);
Route::post('{id}/save_request_pu',[PurchaseController::class,'save_request']);
Route::post('{id}/update_pu',[PurchaseController::class,'update']);
Route::post('{id}/fix_pu',[PurchaseController::class,'fix']);
Route::post('{id}/update_request_pu',[PurchaseController::class,'update_request']);
Route::post('{id}/delete_pu',[PurchaseController::class,'delete']);

Route::post('{id}/accept',[AcceptController::class,'accept']);
Route::post('{id}/reject',[AcceptController::class,'reject']);
Route::post('{id}/cancel',[AcceptController::class,'cancel']);

Route::get('total_pa',[MatterTotalController::class,'total_pa']);
Route::get('{id}/print_total_pa/{year}/{month}',[MatterTotalController::class,'print_total_pa']);

Route::get('matter_search',[ShinseiController::class,'matter_search']);
Route::get('{type}/matter_search',[ShinseiController::class,'matter_search2']);
Route::get('matter_ruling',[ShinseiController::class,'matter_ruling']);
Route::get('{type}/matter_ruling',[ShinseiController::class,'matter_ruling2']);
Route::post('{type}/end_check_pa',[PaidLeaveController::class,'end_check']);
Route::get('/',[DashboardController::class,'show_dash']);
Route::get('/dashboard',[DashboardController::class,'show_dash']);

//Route::get('/', function () { return view('dashboard');})->middleware(['auth'])->name('dashboard');

//Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
