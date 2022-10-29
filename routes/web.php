<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\InitializeAppController;
use App\Http\Controllers\json\UserController as JsonUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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

  Route::get('forgot-password', [ForgotPassword::class, 'index'])->name('forgot-password');
  Route::post('forgot-password', [ForgotPassword::class, 'send'])->name('forgot-password.send');
  Route::get('reset-password/{token}', [ForgotPassword::class, 'resetPasswordForm'])->name('password.reset');
  Route::post('reset-password', [ForgotPassword::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {

  Route::get('/', [DashboardController::class, 'index'])->name('index');

  Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

  // Route::controller(InitializeAppController::class)
  //   ->prefix('initialize-app')
  //   ->name('initialize-app.')
  //   ->group(function () {
  //   });

  Route::prefix('account')
    ->name('account.')
    ->group(function () {
      Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change-password');
      Route::post('change-password', [ChangePasswordController::class, 'update']);
      Route::get('profile', [ProfileController::class, 'index'])->name('profile');
      Route::post('set-education', [ProfileController::class, 'set_education'])->name('set-education');
      Route::post('delete-education', [ProfileController::class, 'delete_education'])->name('delete-education');
      Route::post('update-education', [ProfileController::class, 'update_education'])->name('update-education');
      Route::post('set-achievements', [ProfileController::class, 'set_achievements'])->name('set-achievements');
      Route::post('delete-achievements', [ProfileController::class, 'delete_achievements'])->name('delete-achievements');
      Route::post('update-achievements', [ProfileController::class, 'update_achievements'])->name('update-achievements');
      Route::post('set-experience', [ProfileController::class, 'set_experience'])->name('set-experience');
      Route::post('delete-experience', [ProfileController::class, 'delete_experience'])->name('delete-experience');
      Route::post('update-experience', [ProfileController::class, 'update_experience'])->name('update-experience');
    });


  Route::get('attendance/submit-pass-key', [PresenceController::class, 'updateAttendance'])->name('presences.update-attendance');
  Route::get('presences/{meeting_id}/show-qr', [PresenceController::class, 'showQr'])->name('presences.show-qr');
  Route::post('presences/store-attendance', [PresenceController::class, 'storeAttendances'])->name('presences.store-attendances');
  Route::resource('presences', PresenceController::class);

  Route::prefix('json')
    ->name('json.')
    ->group(function () {
      Route::get('users/get', [JsonUserController::class, 'getUsers'])->name('users.get');
    });




  // NOT FINISHED BUT I COMMITTED ANYWAY
  Route::prefix('system')
    ->name('system.')
    ->group(function () {
      Route::resource('users', UserController::class);

      Route::post('users/roles/store', [UserController::class, 'roleStore'])->name('users.roleStore');
      Route::post('users/roles', [UserController::class, 'roleDestroy'])->name('users.roleDestroy');
    });
});

