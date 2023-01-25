<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_experience extends Model
{
    protected $table = 'experience';
    protected $fillable = ['user_id', 'institution', 'position'];
    use HasFactory;
}
