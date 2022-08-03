<?php

namespace App\Http\Controllers;

use App\Mail\Basic;
use App\Mail\BasicMail;
use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPassword extends Controller
{
  public function index()
  {
    return view('forgot-password');
  }

  public function send(Request $request)
  {
    $validatedInput = $request->validate([
      'email' => 'required|email:dns'
    ]);

    $user = User::where('email', $validatedInput['email'])->first();

    if ($user) {
      $status = Password::sendResetLink(
        $request->only('email')
      );
    }

    return redirect()
      ->route('login')
      ->with(['status' => 'Reset password akun <b> ' . $validatedInput['email']  . ' </b> telah terkirim via email.']);
  }

  public function resetPasswordForm(Request $request, $token)
  {
    $email = $request->email;

    $passwordReset = DB::table('password_resets')->where('email', $email)->first();

    if (!$passwordReset) {
      abort(403, 'Invalid Email');
    }

    if (!Hash::check($token, $passwordReset->token)) {
      abort(403, 'Invalid Token');
    }

    return view('reset-password', compact('token', 'email'));
  }

  public function resetPassword(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => $password
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
      }
    );

    return $status === Password::PASSWORD_RESET
      ? redirect()->route('login')->with('status', 'Password telah diperbarui, silahkan login')
      : back()->withErrors(['email' => [__($status)]]);
  }
}
