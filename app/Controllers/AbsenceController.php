<?php

namespace App\Controllers;

class AbsenceController extends Controller
{
    public function leave()
    {
        session_delete('leave');
        return view('absence.leave');
    }

    public function store()
    {
        // Handle store absence request...
        session_set('leave', request()->input('token'));
        return redirect('/absence/leave/make-up?page=1&token=' . request()->input('token'));
    }

    public function makeUp()
    {
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
        $makeUpData = [
            [
                'id' => 'IELTS 1',
                'class_name' => '3.0-5.0',
                'date' => '2025-01-01',
                'shift' => 'Ca 1'
            ],
            [
                'id' => 'IELTS 2',
                'class_name' => '3.0-5.5',
                'date' => '2025-01-01',
                'shift' => 'Ca 2'
            ],
            [
                'id' => 'IELTS 2',
                'class_name' => '3.0-6.0',
                'date' => '2025-01-01',
                'shift' => 'Ca 3'
            ],
            [
                'id' => 'IELTS 4',
                'class_name' => '3.0-5.0',
                'date' => '2025-01-01',
                'shift' => 'Ca 4'
            ],
            [
                'id' => 'IELTS 5',
                'class_name' => '4.0-5.0',
                'date' => '2025-01-02',
                'shift' => 'Ca 1'
            ]
        ];
        return view('absence.make-up', compact('makeUpData'));
    }

    public function history()
    {
        $historyData = [
            [
                'date' => '2025-01-01',
                'shift' => 'Ca 1',
                'reason' => 'Bị ốm',
            ],
            [
                'date' => '2025-01-01',
                'shift' => 'Ca 2',
                'reason' => 'Bị lười',
            ],
            [
                'date' => '2025-01-01',
                'shift' => 'Ca 3',
                'reason' => 'Bị ốm',
            ],
            [
                'date' => '2025-01-01',
                'shift' => 'Ca 4',
                'reason' => 'Bị ốm',
            ],
            [
                'date' => '2025-01-02',
                'shift' => 'Ca 1',
                'reason' => 'Bị ốm',
            ]
        ];
        return view('absence.history', compact('historyData'));
    }
}
