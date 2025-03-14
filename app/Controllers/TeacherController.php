<?php

namespace App\Controllers;

class TeacherController extends Controller
{
    public function __construct()
    {
        if (!session('user')) {
            return redirect('/login');
        }
        if (session('user')['role'] !== "teacher") {
            return redirect('/');
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

    public function classroomAttendance($id)
    {
        $students = [
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tiến Dũng',
                'day_1' => 'Có',
                'day_2' => 'Không phép',
                'day_3' => 'Có phép',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Minh Đức',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trần Thu Hà',
                'day_1' => 'Có phép',
                'day_2' => 'Có',
                'day_3' => 'Không phép',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Duy Hoàng',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Phạm Anh Kiên',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tấn Lộc',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Nam Phong',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Hà Phương',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Lê Minh Trang',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Thị Phi Yến',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Không phép',
                'day_5' => 'Không phép',
                'day_6' => 'Không phép',
                'day_7' => 'Không phép',
                'day_8' => 'Không phép',
                'day_9' => 'Không phép',
                'day_10' => 'Không phép',
            ],
        ];
        return view('teacher.classroom-attendance', compact('students'));
    }
}
