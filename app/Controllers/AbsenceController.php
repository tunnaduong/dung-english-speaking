<?php

namespace App\Controllers;

use App\Models\Absence;
use App\Models\Classroom;
use App\Models\MakeUpClass;

class AbsenceController extends Controller
{
    public $absence;
    public $classroom;
    public $makeUpClass;

    public function __construct()
    {
        $this->absence = new Absence();
        $this->classroom = new Classroom();
        $this->makeUpClass = new MakeUpClass();
    }

    public function leave()
    {
        if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
            return redirect('/');
        }
        session_delete('leave');
        return view('absence.leave');
    }

    public function store()
    {
        if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
            return redirect('/');
        }
        // Handle store absence request...
        $absence_id = $this->absence::create([
            'student_id' => session('user')['user_id'],
            'date' => request()->input('day_off'),
            'reason' => request()->input('reason'),
        ]);
        session_set('leave', request()->input('token'));
        return redirect('/absence/leave/make-up?token=' . request()->input('token') . '&id=' . $absence_id);
    }

    public function makeUp()
    {
        if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
            return redirect('/');
        }
        if (!session('leave')) {
            session_delete('leave');
            return redirect('/absence/leave');
        }
        if (!request()->input('token')) {
            session_delete('leave');
            return redirect('/absence/leave');
        }
        if (session('leave') !== request()->input('token')) {
            session_delete('leave');
            return redirect('/absence/leave');
        }
        $makeUpData = $this->classroom->getMakeupClasses();
        return view('absence.make-up', compact('makeUpData'));
    }

    public function makeUpClass($id)
    {
        if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
            return redirect('/');
        }

        $makeupId = $this->makeUpClass::create([
            'student_id' => session('user')['user_id'],
            'absence_id' => request()->input('id'),
            'class_id' => $id,
            'date' => date('Y-m-d'),
            'shift_id' => 1,
        ]);

        $this->absence::update([
            'makeup_class_id' => $makeupId,
        ], ['absence_id' => request()->input('id')]);

        return redirect('/absence/history');
    }

    public function history()
    {
        if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
            return redirect('/');
        }
        $historyData = $this->absence->getAbsenceHistory(session('user')['id']);
        return view('absence.history', compact('historyData'));
    }
}
