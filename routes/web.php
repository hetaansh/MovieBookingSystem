<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\OperatorsController;
use App\Http\Controllers\OperatorUsersController;



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

Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/dashboard',function(){
    return view('home');
})->middleware('auth:admin');

Route::get('/operator',[LoginController::class,'showOperatorLoginForm'])->name('operator.login-view');
Route::post('/operator',[LoginController::class,'operatorLogin'])->name('operator.login');

Route::get('/operator/dashboard',function(){
    return view('home');
})->middleware('auth:operator');



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



Route::get('/admin/operators', [OperatorsController::class, 'show'])
->name('admin.operators')->middleware('auth:admin'); 

Route::get('/admin/operators/add',[OperatorsController::class,'showAddOperatorPage'])
->name('admin.operators.show')->middleware('auth:admin'); 

Route::post('/admin/operators/add',[OperatorsController::class,'AddOperator'])
->name('admin.operators.add')->middleware('auth:admin'); 

Route::get('/admin/operators/update/{id}',[OperatorsController::class,'showEditOperatorPage'])
->name('admin.operators.edit.show')->middleware('auth:admin'); 

Route::post('/admin/operators/update/',[OperatorsController::class,'EditOperator'])
->name('admin.operators.edit')->middleware('auth:admin'); 

Route::get('/admin/operators/delete/{id}',[OperatorsController::class,'deleteOperator'])
->name('admin.operators.delete')->middleware('auth:admin'); 



Route::get('/admin/operatorUsers', [OperatorUsersController::class, 'show'])
->name('admin.operatorUsers')->middleware('auth:admin'); 

Route::get('/admin/operatorUsers/add',[OperatorUsersController::class,'showAddOperatorUsersPage'])
->name('admin.operatorUsers.show')->middleware('auth:admin'); 

Route::post('/admin/operatorUsers/add',[OperatorUsersController::class,'AddOperatorUsers'])
->name('admin.operatorUsers.add')->middleware('auth:admin'); 

Route::get('/admin/operatorUsers/update/{id}',[OperatorUsersController::class,'showEditOperatorUsersPage'])
->name('admin.operaoperatorUserstors.edit.show')->middleware('auth:admin'); 

Route::post('/admin/operatorUsers/update/',[OperatorUsersController::class,'EditOperatorUsers'])
->name('admin.operatorUsers.edit')->middleware('auth:admin'); 

Route::get('/admin/operatorUsers/delete/{id}',[OperatorUsersController::class,'deleteOperatorUsers'])
->name('admin.operatorUsers.delete')->middleware('auth:admin'); 






