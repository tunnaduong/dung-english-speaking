<?php

namespace App\Controllers;

class TeacherController extends Controller
{
    public function classroom()
    {
        return view('teacher.classrooms');
    }
}
