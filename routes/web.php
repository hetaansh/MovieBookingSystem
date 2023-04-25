<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\OperatorUserController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OperatorPasswordController;
use App\Http\Controllers\OperatorProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\StateController;

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

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/operator/dashboard', function () {
    return view('home');
})->middleware('auth:operator');

Route::get('/admin/dashboard', function () {
    return view('home');
})->middleware('auth:admin');

Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/operator', [LoginController::class, 'showOperatorLoginForm'])->name('operator.login-view');
Route::post('/operator', [LoginController::class, 'operatorLogin'])->name('operator.login');


Route::get('/admin/email', [ResetPasswordController::class, 'showAdminResetForm'])->name('admin.reset');
Route::post('/admin/email', [ResetPasswordController::class, 'sendAdminResetForm'])->name('admin.email');

Route::get('/admin/reset/{token}', [ConfirmPasswordController::class, 'adminCreate'])
    ->name('admin.password.confirm');

Route::post('/admin/confirm', [ConfirmPasswordController::class, 'adminStore'])
    ->name('admin.password.store');

Route::get('/operator/email', [ResetPasswordController::class, 'showOperatorResetForm'])->name('operator.reset');
Route::post('/operator/email', [ResetPasswordController::class, 'sendOperatorResetForm'])->name('operator.email');

Route::get('/operator/reset/{token}', [ConfirmPasswordController::class, 'operatorCreate'])
    ->name('operator.passwordss.confirm');

Route::post('/operator/confirm', [ConfirmPasswordController::class, 'operatorStore'])
    ->name('operator.passwordss.store');


Route::get('admin/operators/datatable', [OperatorController::class, 'datatable'])->middleware('auth:admin')->name('operators.datatable');
Route::resource('admin/operators', OperatorController::class)->middleware('auth:admin');

Route::get('admin/operatorUsers/datatable', [OperatorUserController::class, 'datatable'])->middleware('auth:admin')->name('operatorUsers.datatable');
Route::resource('admin/operatorUsers', OperatorUserController::class)->middleware('auth:admin');

Route::get('admin/cities/datatable', [CityController::class, 'datatable'])->middleware('auth:admin')->name('cities.datatable');
Route::resource('admin/cities', CityController::class)->middleware('auth:admin');

Route::get('admin/states/datatable', [StateController::class, 'datatable'])->middleware('auth:admin')->name('states.datatable');
Route::resource('admin/states', StateController::class)->middleware('auth:admin');

Route::get('admin/movies/datatable', [MovieController::class, 'datatable'])->middleware('auth:admin')->name('movies.datatable');
Route::resource('admin/movies', MovieController::class)->middleware('auth:admin');

Route::resource('admin/profiles', ProfileController::class)->middleware('auth:admin');

Route::resource('admin/passwords', PasswordController::class)->middleware('auth:admin');

Route::get('operator/cinemas/datatable', [CinemaController::class, 'datatable'])->middleware('auth:operator')->name('cinemas.datatable');
Route::resource('operator/cinemas', CinemaController::class)->middleware('auth:operator');

Route::get('operator/screens/datatable', [ScreenController::class, 'datatable'])->middleware('auth:operator')->name('screens.datatable');
Route::resource('operator/screens', ScreenController::class)->middleware('auth:operator');

Route::resource('operator/profile', OperatorProfileController::class)->middleware('auth:operator');


Route::post('operator/shows/isShowAvailable', [ShowController::class, 'isShowAvailable'])->middleware('auth:operator')->name('shows.isShowAvailable');
Route::post('operator/shows/getMovie', [ShowController::class, 'getMovie'])->middleware('auth:operator')->name('shows.getMovie');
Route::post('operator/shows/getScreen', [ShowController::class, 'getScreen'])->middleware('auth:operator')->name('shows.getScreen');
Route::get('operator/shows/datatable', [ShowController::class, 'datatable'])->middleware('auth:operator')->name('shows.datatable');
Route::resource('operator/shows', ShowController::class)->middleware('auth:operator');

Route::resource('operator/seats', SeatController::class)->middleware('auth:operator');
Route::post('operator/seats/getSelectedTickets', [SeatController::class, 'getSelectedTickets'])->middleware('auth:operator')->name('seats.getSelectedTickets');
Route::post('operator/seats/getTickets', [SeatController::class, 'getTickets'])->middleware('auth:operator')->name('seats.getTickets');
Route::post('operator/seats/getScreen', [SeatController::class, 'getScreen'])->middleware('auth:operator')->name('seats.getScreen');
Route::post('operator/seats/getSeats', [SeatController::class, 'getSeats'])->middleware('auth:operator')->name('seats.getSeat');
Route::post('operator/seats/getShows', [SeatController::class, 'getShows'])->middleware('auth:operator')->name('seats.getShow');




Route::get('operator/bookings/datatable', [BookingController::class, 'datatable'])->middleware('auth:operator')->name('bookings.datatable');
Route::resource('operator/bookings', BookingController::class)->middleware('auth:operator');

// Route::resource('operator/password', OperatorPasswordController::class)->middleware('auth:operator');
