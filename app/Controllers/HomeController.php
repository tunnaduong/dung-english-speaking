<?php

namespace App\Controllers;

class HomeController extends Controller
{
  public function index()
  {
    return redirect('/profile');
  }

  public function profile()
  {
    return view('home.profile');
  }
}
