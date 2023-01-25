<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;

use Auth;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard');
  }
}
