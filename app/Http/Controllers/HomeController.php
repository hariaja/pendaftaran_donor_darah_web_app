<?php

namespace App\Http\Controllers;

use App\Helpers\Enum\RoleType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    if (isRoleName() !== RoleType::DONOR->value) {
      return view('home');
    } else {
      return redirect(route('donors.home'));
    }
  }
}
