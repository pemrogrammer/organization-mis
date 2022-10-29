<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements CanResetPassword
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_user_set_password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
      return $this->hasManyThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }

    public function menus()
    {
      return $this->hasManyThrough(Menu::class, UserMenu::class, 'user_id', 'id', 'id', 'menu_id');
    }

    public function educations(){
      return $this->hasManyThrough(education::class, user_education::class, 'user_id', 'id', 'id', 'education_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function achievements(){
        return $this->hasMany(user_achievements::class);
    }

    public function experience(){
        return $this->hasMany(user_experience::class);
    }
}
