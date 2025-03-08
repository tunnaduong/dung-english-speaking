<?php

namespace App\Controllers;

class AbsenceController extends Controller
{
    public function leave()
    {
        return view('absence.leave');
    }

    public function store()
    {
        // Handle store absence request...
        return redirect('/absence/leave/make-up');
    }

    public function makeUp()
    {
        return view('absence.make-up');
    }
}
