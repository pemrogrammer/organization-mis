<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

use File;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::paginate(25);
    return view('system.users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $user = new User;
    return view('system.users.form', ['user' => $user]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedInput = $request->validate([
      'name' => 'required|max:255',
      'email' => 'required|unique:users|email:dns',
      'password' => 'required|confirmed|min:8|max:255',
    ]);
    
    User::create($validatedInput);

    return redirect()->route('system.users.index')->with('alerts', [
      [
        'class' => 'success',
        'message' => 'Berhasil membuat pengguna ' . $validatedInput['name'] . '.'
      ]
    ]);
  }

  public function roleStore(Request $request)
  {
    $validatedInput = $request->validate([
      'user_id' => 'required|exists:users,id',
      'role_id' => 'required|exists:roles,id'
    ]);

    UserRole::firstOrCreate($validatedInput);
    
    return redirect(route('system.users.edit', $request->user_id))->with('message', [
      'class' => 'success',
      'text' => 'Berhasil menambahkan peran sistem'
    ]);
  }

  public function roleDestroy(Request $request)
  {
    $validatedInput = $request->validate([
      'user_id' => 'required|exists:users,id',
      'role_id' => 'required|exists:roles,id'
    ]);

    UserRole::where('user_id', $validatedInput['user_id'])->where('role_id', $validatedInput['role_id'])->delete();

    return redirect(route('system.users.edit', $request->user_id))->with('message', [
      'class' => 'warning',
      'text' => 'Berhasil menghapus peran sistem'
    ]);

  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $roles = Role::all();
    $profile = 0;
    return view('system.users.form', compact('user', 'roles', 'profile'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    $ubah = User::find($request->user_id);
    $ubah->is_male = ($request->isMale == 'on' ? 1 : 0);
    $ubah->religion = $request->religion;
    $ubah->birth_date = $request->birthDate;
    $ubah->birth_city = $request->birthCity;
    $ubah->hobby = $request->hobi;
    $ubah->motto = $request->moto;
    $ubah->bio = $request->bio;
    $ubah->id_number = $request->id_number;
    if ($request->foto) {
      $foto = ['png', 'jpeg', 'jpg'];
      if (in_array($request->file('foto')->extension(), $foto)) {
        if (File::exists('assets/foto/'.$ubah->img_path)) {
          File::delete('assets/foto/'.$ubah->img_path);
          $name = time().'.'.$request->file('foto')->extension();
          $request->file('foto')->move('assets/foto', $name);
          $ubah->img_path = $name;
        } else {
          $name = time().'.'.$request->file('foto')->extension();
          $request->file('foto')->move('assets/foto', $name);
          $ubah->img_path = $name;
        }
      } else {
        return redirect(route('account.profile', $user))->with('message', [
          'class' => 'danger',
          'text' => 'File hanya boleh ber-extensi : .png, .jpg, .jpeg'
        ]);
      }
    }
    $ubah->update();

    if ($request->profile == 0) {
      return redirect(route('system.users.edit', $user))->with('message', [
        'class' => 'success',
        'text' => 'Berhasil menyimpan perubahan'
      ]);
    } else {
      return redirect(route('account.profile'))->with('message', [
        'class' => 'success',
        'text' => 'Berhasil menyimpan perubahan'
      ]);
    }

    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    //
  }
}
