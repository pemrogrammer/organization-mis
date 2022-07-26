<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
  public function index()
  {
    return view('login.index');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email:dns',
      'password' => 'required|min:8|max:255',
    ]);


    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('/');
    }


    return back()->withErrors(['attemp' => 'email dan password tidak sesuai']);
  }

  public function googleOauth()
  {
    return Socialite::driver('google')->redirect();
  }

  public function handleGoogleOauth()
  {
    $googleUser = Socialite::driver('google')->user();

    $user = User::firstWhere('email', $googleUser->getEmail());

    $isUserFound = $user !== null;

    if ($isUserFound) {
      Auth::login($user);
      
      return redirect()->intended('/');
    }

    return redirect()->route('login')->withErrors([
      'attemp' => 'email <strong>' . $googleUser->getEmail() . '</strong> tidak terdaftar pada sistem, silahkan menghubungi admin.'
    ]);
  }
}
