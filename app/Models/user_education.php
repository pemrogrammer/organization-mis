<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_education extends Model
{
    use HasFactory;

    protected $table = 'user_educations';

    protected $fillable = ['id_user', 'education_id', 'from_year', 'to_year', 'institution'];

    public function edu(){
        return $this->belongsTo('education', 'id', 'education_id');
    }
}
