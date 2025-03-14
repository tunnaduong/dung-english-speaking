<?php

namespace App\Controllers;

class TeacherController extends Controller
{
    public function __construct()
    {
        if (!session('user')) {
            redirect('/login');
        }
        if (session('user')['role'] !== "teacher") {
            redirect('/');
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
        $curriculums = [
            [
                'session' => 'BG01001',
                'topic' => 'Reading 1: Thay đổi tư duy đọc tiếng Anh',
                'date' => '2025-01-06',
            ],
            [
                'session' => 'BG01002',
                'topic' => 'Writing 1: Thay đổi tư duy viết tiếng Anh',
                'date' => '2025-01-08',
            ],
            [
                'session' => 'BG01003',
                'topic' => 'Speaking 1: Thay đổi tư duy nói tiếng Anh',
                'date' => '2025-01-10',
            ],
            [
                'session' => 'BG01004',
                'topic' => 'Reading 2: Cách đọc cấu trúc câu',
                'date' => '2025-01-13',
            ],
            [
                'session' => 'BG01005',
                'topic' => 'Writing 2: Cách học Verb patterns hiệu quả',
                'date' => '2025-01-15',
            ],
            [
                'session' => 'BG01006',
                'topic' => 'Speaking 2: Cách dùng Verb patterns để nói về Advantages',
                'date' => '2025-01-17',
            ],
            [
                'session' => 'BG01007',
                'topic' => 'Reading 3: Áp dụng đọc cấu trúc câu để làm dạng  True/ False/ Not Given',
                'date' => '2025-01-20',
            ],
            [
                'session' => 'BG01008',
                'topic' => 'Writing 3: S V agreement',
                'date' => '2025-01-22',
            ],
            [
                'session' => 'BG01009',
                'topic' => 'Speaking 3: Cách dùng Verb patterns để diễn tả Feelings',
                'date' => '2025-01-24',
            ],
            [
                'session' => 'BG01010',
                'topic' => 'Reading 4: Cách áp dụng đọc cấu trúc câu để trả lời dạng bài Gap-Fill',
                'date' => '2025-01-27',
            ],
        ];
        return view('teacher.classroom-curriculum', compact('curriculums'));
    }

    public function classroomAttendance($id)
    {
        $students = [
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tiến Dũng',
                'day_1' => 'Không phép',
                'day_2' => 'Có',
                'day_3' => 'Có phép',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Minh Đức',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Không phép',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trần Thu Hà',
                'day_1' => 'Có phép',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Duy Hoàng',
                'day_1' => 'Có',
                'day_2' => 'Không phép',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Phạm Anh Kiên',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tấn Lộc',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Nam Phong',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Hà Phương',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Lê Minh Trang',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Thị Phi Yến',
                'day_1' => 'Có',
                'day_2' => 'Có',
                'day_3' => 'Có',
                'day_4' => 'Có',
                'day_5' => 'Có',
                'day_6' => 'Có',
                'day_7' => 'Có',
                'day_8' => 'Có',
                'day_9' => 'Có',
                'day_10' => 'Có',
            ],
        ];
        return view('teacher.classroom-attendance', compact('students'));
    }

    public function editCurriculum($id, $curriculumId)
    {
        $curriculum = [
            'session' => 'BG01001',
            'topic' => 'Reading 1: Thay đổi tư duy đọc tiếng Anh',
            'date' => '2025-01-06',
        ];
        return view('teacher.edit-curriculum', compact('curriculum'));
    }

    public function updateCurriculum($id, $curriculumId)
    {
        return redirect("/classrooms/$id/curriculum");
    }

    public function deleteCurriculum($id, $curriculumId)
    {
        return redirect("/classrooms/$id/curriculum");
    }

    public function addCurriculum($id)
    {
        return view('teacher.add-curriculum');
    }
}
