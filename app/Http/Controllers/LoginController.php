<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
  public function index()
  {
    return view('login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email:dns',
      'password' => 'required|min:8|max:255',
    ]);


    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      $request->session()->regenerate();
      $request->session()->put('menus', $this->getUserMenus());
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
      session()->regenerate();
      session()->put('menus', $this->getUserMenus());

      return $user->password
        ? redirect()->intended('/')
        : redirect()->intended('/')->with('alerts', [
          [
            'class' => 'warning',
            'message' => 'Password belum diator, silahkan <a href="' . route('profile.setPassword') . '">atur password</a>.'
          ]
        ]);
    }

    return redirect()->route('login')->withErrors([
      'attemp' => 'email <strong>' . $googleUser->getEmail() . '</strong> tidak terdaftar pada sistem, silahkan menghubungi admin.'
    ]);
  }

  private function getUserMenus()
  {
    $user = Auth::user();

    if ($user->is_admin) {
      $menus = Menu::all();
    } else {
      $user = User::with(['roles.menus', 'menus'])->find($user->id);
      $menus = $user->menus;

      foreach ($user->roles as $role) {
        $menus = $menus->union($role->menus);
      }

      $menus = $menus->unique(function ($item) {
        return $item['id'];
      });
    }

    return $menus;
  }
}
