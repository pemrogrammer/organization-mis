<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $user = Auth::user();
    $meetingQuery = Meeting::with('attendances.user')
      ->where(function ($query) use ($user) {
        return $query->where('created_by_user_id', $user->id)
          ->orWhereHas('attendances', function ($query) use ($user) {
            return $query->where('user_id', $user->id);
          });
      });

    $upcomingMeetings = (clone $meetingQuery)
      ->where('at', '>', now()->subMinutes(15))
      ->orderBy('at')
      ->take(3)
      ->get();


    $allMeetings = $meetingQuery->orderBy('id', 'DESC')->paginate(25);


    return view('presences.index', compact('allMeetings', 'upcomingMeetings', 'user'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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
      'meeting_id' => 'nullable',
      'name' => 'required',
      'location' => '',
      'at' => 'required',
      'category' => '',
      'description' => '',
      'pass_key' => 'unique:meetings,pass_key',
      'expired_at_min' => ''
    ]);


    $validatedInput['created_by_user_id'] = Auth::user()->id;
    $validatedInput['at'] = Carbon::createFromFormat('Y-m-d\TH:i', $validatedInput['at']);

    $meeting_id = $validatedInput['meeting_id']
      ? $request->validate([
        'meeting_id' => 'required|exists:meetings,id'
      ])['meeting_id']
      : null;

    unset($validatedInput['meeting_id']);

    $meeting = Meeting::updateOrCreate(['id' => ($meeting_id)], $validatedInput);

    return back()->with('alerts', [
      [
        'class' => 'success',
        'message' => 'Berhasil ' . ($meeting_id ? 'menympan' : 'menambahkan') . ' agenda ' . $meeting->name
      ]
    ]);
  }

  public function storeAttendances(Request $request)
  {
    $validatedInput = $request->validate([
      'meeting_id' => 'required|integer|exists:meetings,id',
      'user_ids' => 'required|exists:users,id'
    ]);

    $meetingAttendances = [];

    foreach ($validatedInput['user_ids'] as $user_id) {
      $meetingAttendances[] = [
        'user_id' => $user_id,
        'meeting_id' => $validatedInput['meeting_id'],
        'is_should_attend' => true
      ];
    }

    MeetingAttendance::insert($meetingAttendances);

    return back()->with('alerts', [
      [
        'class' => 'success',
        'message' => 'Berhasil menambahkan peserta'
      ]
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Meeting  $meeting
   * @return \Illuminate\Http\Response
   */
  public function show(Meeting $meeting)
  {
    //
  }

  private function randomNumber($length)
  {
    $result = '';

    for ($i = 0; $i < $length; $i++) {
      $result .= mt_rand(0, 9);
    }

    return $result;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Meeting  $meeting
   * @return \Illuminate\Http\Response
   */
  public function showQr($meeting_id)
  {
    $meeting = Meeting::find($meeting_id);

    if ($meeting->created_by_user_id !== Auth::user()->id) {
      abort(403, 'Anda tidak berhak mengakses halaman ini');
    }

    // if(! $meeting->is_at_toleranced) {
    //   abort(403, 'Pertemuan telah berakhir');
    // }

    Meeting::where('pass_key_expired_at', '<', now())->update([
      'pass_key' => null,
      'pass_key_expired_at' => null
    ]);

    if (!$meeting->pass_key_expired_at || $meeting->pass_key_expired_at < now()) {

      $isNewPassKeyFound = false;

      while (!$isNewPassKeyFound) {
        $new_pass_key = $this->randomNumber(6);

        $isPassKeyInexists = Meeting::where('pass_key', $new_pass_key)->count() == 0;

        if ($isPassKeyInexists) {
          $meeting->pass_key = $new_pass_key;
          $meeting->pass_key_expired_at = now()->addMinutes(5);

          $meeting->save();

          $isNewPassKeyFound = true;
        }
      }
    }

    return view('presences.show-qr', compact('meeting'));
  }

  public function updateAttendance(Request $request)
  {
    $pass_key = $request->validate([
      'pass_key' => 'required'
    ]);


    $meeting = Meeting::where('pass_key', $pass_key)->first();

    if (!$meeting) {
      return back()->with('alerts', [
        [
          'class' => 'danger',
          'message' => 'Kode tidak dikenali'
        ]
      ]);
    }

    if ($meeting->pass_key_expired_at < now()) {
      return back()->with('alerts', [
        [
          'class' => 'danger',
          'message' => 'Kode Presensi kadaluarsa'
        ]
      ]);
    }

    $meetingAttendance = MeetingAttendance::firstOrNew(
      [
        'user_id' => Auth::user()->id,
        'meeting_id' => $meeting->id
      ]
    );


    if ($meetingAttendance->attended_at) {
      return back()->with('alerts', [
        [
          'class' => 'warning',
          'message' => 'Kehadiran anda sudah tercatat sebelumnya'
        ]
      ]);
    }

    $meetingAttendance->attended_at = now();

    if ($meetingAttendance->is_should_attend == null) {
      $meetingAttendance->is_should_attend = false;
    }

    if ($meetingAttendance->exists) {
      MeetingAttendance::where([
        'user_id' => $meetingAttendance->user_id,
        'meeting_id' => $meetingAttendance->meeting_id
      ])->update([
        'is_should_attend' => $meetingAttendance->is_should_attend,
        'attended_at' => $meetingAttendance->attended_at
      ]);
    } else {
      MeetingAttendance::insert([
        'user_id' => $meetingAttendance->user_id,
        'meeting_id' => $meetingAttendance->meeting_id,
        'is_should_attend' => $meetingAttendance->is_should_attend,
        'attended_at' => $meetingAttendance->attended_at
      ]);
    }

    return back()->with('alerts', [
      [
        'class' => 'success',
        'message' => 'Kehadiran anda berhasil dicatat'
      ]
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Meeting  $meeting
   * @return \Illuminate\Http\Response
   */
  public function edit(Meeting $meeting)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Meeting  $meeting
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Meeting $meeting)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Meeting  $meeting
   * @return \Illuminate\Http\Response
   */
  public function destroy(Meeting $meeting)
  {
    //
  }
}
