<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_achievements extends Model
{
    use HasFactory;
    protected $table = 'achievements';
    protected $fillable = ['user_id', 'description'];
}
