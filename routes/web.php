<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\OperatorUserController;
use App\Http\Controllers\OperatorController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/operator/dashboard',function(){
    return view('home');
})->middleware('auth:operator');

Route::get('/admin/dashboard',function(){
    return view('home');
})->middleware('auth:admin');

Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/operator',[LoginController::class,'showOperatorLoginForm'])->name('operator.login-view');
Route::post('/operator',[LoginController::class,'operatorLogin'])->name('operator.login');




Route::get('/admin/email',[ResetPasswordController::class,'showAdminResetForm'])->name('admin.reset');
Route::post('/admin/email',[ResetPasswordController::class,'sendAdminResetForm'])->name('admin.email');

Route::get('/admin/reset/{token}', [ConfirmPasswordController::class, 'adminCreate'])
->name('admin.password.confirm');

Route::post('/admin/confirm', [ConfirmPasswordController::class, 'adminStore'])
->name('admin.password.store'); 

Route::get('/operator/email',[ResetPasswordController::class,'showOperatorResetForm'])->name('operator.reset');
Route::post('/operator/email',[ResetPasswordController::class,'sendOperatorResetForm'])->name('operator.email');

Route::get('/operator/reset/{token}', [ConfirmPasswordController::class, 'operatorCreate'])
->name('operator.password.confirm');

Route::post('/operator/confirm', [ConfirmPasswordController::class, 'operatorStore'])
->name('operator.password.store'); 



Route::resource('admin/operators', OperatorController::class)->middleware('auth:admin');

Route::resource('admin/operatorUsers', OperatorUserController::class)->middleware('auth:admin');

Route::resource('operator/operatorUsers', OperatorUserController::class)->middleware('auth:operator');


