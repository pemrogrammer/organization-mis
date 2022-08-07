<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'at',
    'location',
    'description',
    'category',
    'pass_key',
    'pass_key_expired_at',
    'created_by_user_id'
  ];

  protected $casts = [
    'at' => 'datetime',
    'pass_key_expired_at' => 'datetime',
  ];

  protected $appends = ['datetime_local_at', 'is_at_toleranced'];

  public function getDatetimeLocalAtAttribute()
    {
        return $this->at ? $this->at->format('Y-m-d\TH:i') : null;
    }

  public function attendances()
  {
    return $this->hasMany(MeetingAttendance::class);
  }

  public function getNAttendAttribute()
  {
    return $this->attendances->filter(function($attendance) {
      return $attendance->attended_at;
    });
  }

  public function getisAtTolerancedAttribute()
  {
    return $this->at->copy()->addDay() > now();
  }
}
