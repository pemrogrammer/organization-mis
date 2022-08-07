<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'meeting_id',
      'is_should_attend',
    ];
  
    protected $casts = [
      'attended_at' => 'datetime'
    ];

    protected $appends = [
      'attended_at_diff_for_humans',
      'attended_at_from_meeting_at_diff_for_humans'
    ];

    public function getAttendedAtDiffForHumansAttribute()
    {
        return $this->attended_at ? $this->attended_at->diffForHumans() : null;
    }

    public function getAttendedAtFromMeetingAtDiffForHumansAttribute()
    {
        return $this->attended_at ? $this->attended_at->diffForHumans($this->meeting->at) : null;
    }

    public function meeting()
    {
      return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
