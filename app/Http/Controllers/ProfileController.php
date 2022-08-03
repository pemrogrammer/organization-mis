<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function setPasswordForm()
    {
      $user = Auth::user();
      return view('profile.set-password', compact('user'));
    }

    public function setPassword(Request $request)
    {
      $user = Auth::user();

      $request->validate([
        'new_password' => 'required|confirmed'
      ]);

      if($user->password) {
        $request->validate([
          'old_password' => 'required|min:8|max:255',
          'new_password' => 'required|confirmed|min:8|max:255'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
          return back()->withErrors(['password' => 'Password salah, silahkan ulangi lagi.']);
        }
      }

      $user->password = $request->new_password;
      $user->save();

      return back()->with('alerts', [
        [
          'class' => 'success',
          'message' => 'Berhasil mengubah password.'
        ]
      ]);
    }
}
