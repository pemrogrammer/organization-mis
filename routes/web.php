<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InitializeAppController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('initialize-app', [InitializeAppController::class, 'index']);
Route::get('initialize-app/check', [InitializeAppController::class, 'check'])->name('initialize-app.check');

Route::middleware('guest')->group(function () {
  Route::controller(InitializeAppController::class)
    ->prefix('initialize-app')
    ->name('initialize-app.')
    ->group(function () {
      Route::get('admin-user', 'createAdminUser')->name('create-admin-user');
      Route::post('admin-user', 'storeAdminUser')->name('store-admin-user');
      Route::get('admin-user/oauth/google', 'signUpWithGoogle')->name('sign-up-admin-with-google');
      Route::get('admin-user/oauth/google/redirect', 'handleGoogleCallback')->name('sign-up-admin-with-google-callback');
    });

  Route::get('login', [LoginController::class, 'index'])->name('login');

  Route::controller(LoginController::class)
    ->prefix('login')
    ->name('login.')
    ->group(function () {
      Route::post('/', 'login')->name('login');
      Route::get('oauth/google', 'googleOauth')->name('oauth.google');
      Route::get('oauth/google/redirect', 'handleGoogleOauth')->name('oauth.google.callback');
    });
});

Route::middleware('auth')->group(function () {

  Route::get('/', [DashboardController::class, 'index'])->name('index');

  Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

  // Route::controller(InitializeAppController::class)
  //   ->prefix('initialize-app')
  //   ->name('initialize-app.')
  //   ->group(function () {
  //   });

  Route::resource('users', UserController::class);
  Route::post('users/roles/store', [UserController::class, 'roleStore'])->name('users.roleStore');
  Route::post('users/roles', [UserController::class, 'roleDestroy'])->name('users.roleDestroy');

});
