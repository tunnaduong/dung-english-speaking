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
}
