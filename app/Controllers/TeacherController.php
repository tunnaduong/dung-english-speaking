<?php

namespace App\Controllers;

class TeacherController extends Controller
{
    public function __construct()
    {
        if (!session('user')) {
            return redirect('/login');
        }
    }

    public function classroom()
    {
        return view('teacher.classrooms');
    }
}
