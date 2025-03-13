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

    public function classroomList($id)
    {
        $students = [
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tiến Dũng',
                'gender' => 'Male',
                'birth_date' => '2003-05-25',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Minh Đức',
                'gender' => 'Male',
                'birth_date' => '2002-02-02',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trần Thu Hà',
                'gender' => 'Female',
                'birth_date' => '2006-12-15',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Duy Hoàng',
                'gender' => 'Male',
                'birth_date' => '2004-09-28',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Phạm Anh Kiên',
                'gender' => 'Male',
                'birth_date' => '2009-01-24',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tấn Lộc',
                'gender' => 'Male',
                'birth_date' => '2005-08-14',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Nam Phong',
                'gender' => 'Male',
                'birth_date' => '2006-09-23',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Hà Phương',
                'gender' => 'Female',
                'birth_date' => '2006-11-01',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Lê Minh Trang',
                'gender' => 'Female',
                'birth_date' => '2007-01-10',
                'phone' => '0394519379',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Thị Phi Yến',
                'gender' => 'Female',
                'birth_date' => '2002-09-05',
                'phone' => '0394519379',
            ],
        ];
        return view('teacher.classroom-list', compact('students'));
    }

    public function classroomCurriculum($id)
    {
        return view('teacher.classroom-curriculum');
    }
}
