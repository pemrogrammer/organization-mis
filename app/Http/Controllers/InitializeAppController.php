<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class InitializeAppController extends Controller
{
  private function isAdminExist()
  {
    return User::where('is_admin', true)->count() > 0;    
  }

  public function check()
  {
    if (!$this->isAdminExist()) {
      return redirect()->route('initialize-app.create-admin-user');
    }


    return redirect('/');
  }

  public function index()
  {
    return redirect()->route('initialize-app.check');
  }


  public function createAdminUser()
  {
    if ($this->isAdminExist()) {
      abort('401');
    }

    return view('initialize-app.admin-user-form');
  }




  public function storeAdminUser(Request $request)
  {
    $validatedInput = $request->validate([
      'name' => 'required|max:255',
      'email' => 'required|unique:users|email:dns',
      'password' => 'required|confirmed|min:8|max:255',
    ]);

    $validatedInput['is_admin'] = true;

    $user = User::create($validatedInput);

    Auth::login($user);

    return redirect()->route('initialize-app.check');
  }

  public function signUpWithGoogle()
  {

    return Socialite::driver('google')
      ->redirectUrl(route('initialize-app.sign-up-admin-with-google-callback'))
      ->redirect();
  }

  public function handleGoogleCallback(Request $request)
  {
    $googleUser = Socialite::driver('google')
      ->redirectUrl(route('initialize-app.sign-up-admin-with-google-callback'))
      ->stateless()
      ->user();

    $user = User::create([
      'name' => $googleUser->name,
      'email' => $googleUser->email,
      'google_id' => $googleUser->id,
      'is_admin' => true
    ]);

    Auth::login($user);

    return redirect(route('initialize-app.check'));
  }
}
