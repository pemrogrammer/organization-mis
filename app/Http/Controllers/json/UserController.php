<?php

namespace App\Http\Controllers\json;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  private function formatJsonResponse($status = null, $message = null, $data = null)
  {
    return response()->json([
      'status' => $status,
      'message' => $message,
      'data' => $data
    ]);
  }

  public function getUsers(Request $request)
  {
    if (!$request->q) {
      return $this->formatJsonResponse('error', 'q cannot be null');
    }

    if (strlen($request->q) < 4) {
      return $this->formatJsonResponse('error', 'q cannot less than 4 character');
    }


    $users = User::where('name', 'LIKE', '%' . $request->q . '%')
      ->orwhere('id_number', 'LIKE', '%' . $request->q . '%')->orderBy('name')->get();

    return $this->formatJsonResponse('success', null, $users);
  }
}
