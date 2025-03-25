<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Classroom;
use App\Models\InfoStudent;

class TeacherController extends Controller
{
    public $classroom;
    public $studentInfo;
    public $course;

    public function __construct()
    {
        $this->studentInfo = new InfoStudent();
        $this->classroom = new Classroom();
        $this->course = new Course();
        if (!session('user')) {
            redirect('/login');
        }
        if (session('user')['role'] !== "Teacher" && session('user')['role'] !== 'Teaching Assistant' && session('user')['role'] !== "Academic Affair") {
            redirect('/');
        }
    }

    public function classroom()
    {
        if (session('user')['role'] === 'Academic Affair') {
            return view('admin.classrooms');
        }
        $classrooms = $this->classroom->getClasses(session('user')['user_id']);
        return view('teacher.classrooms', compact('classrooms'));
    }

    public function classroomList($id)
    {
        $students = $this->studentInfo->getStudents($id);
        if (session('user')['role'] === 'Academic Affair') {
            return view('admin.classrooms--list', compact('students'));
        }
        return view('teacher.classroom-list', compact('students'));
    }

    public function classroomCurriculum($id)
    {
        $course = $this->course->getCourseByClassId($id);
        $curriculums = $this->course->getCourseContent($id);
        return view('teacher.classroom-curriculum', compact('curriculums', 'id', 'course'));
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
        if (request()->isMethod('post')) {
            return redirect("/classrooms/$id/curriculum");
        }
        return view('teacher.edit-curriculum', compact('id', 'curriculumId'));
    }

    public function deleteCurriculum($id, $curriculumId)
    {
        return redirect("/classrooms/$id/curriculum");
    }

    public function addCurriculum($id)
    {
        if (request()->isMethod('post')) {
            return redirect("/classrooms/$id/curriculum");
        }
        return view('teacher.add-curriculum', compact('id'));
    }

    public function editCourse($id)
    {
        if (request()->isMethod('post')) {
            return redirect("/courses");
        }
        return view('teacher.edit-course');
    }

    public function students()
    {
        $students = $this->studentInfo::getAllStudents();
        // if has search query
        if (request()->get('search')) {
            $students = $this->studentInfo::searchStudentsByName(request()->get('search'));
        }
        return view('teacher.students', compact('students'));
    }

    public function studentProfile($id)
    {
        $student = $this->studentInfo::getStudentById($id);
        return view('teacher.student-profile', compact('id', 'student'));
    }

    public function studentProfileClassDetail($id, $classId)
    {
        return view('teacher.student-profile-class-detail', compact('id'));
    }

    public function correction()
    {
        $classrooms = $this->classroom->getClasses(session('user')['user_id']);
        return view('teacher.correction', compact('classrooms'));
    }

    public function createExercise()
    {
        if (request()->isMethod('post')) {
            return redirect('/exercises');
        }
        return view('teacher.create-exercise');
    }

    public function editExercise($id)
    {
        if (request()->isMethod('post')) {
            return redirect('/exercises');
        }
        return view('teacher.edit-exercise', compact('id'));
    }

    public function deleteExercise($id)
    {
        return redirect('/exercises');
    }

    public function correctionHomework($id)
    {
        $exercises = [
            [
                'id' => 'E00001',
                'name' => 'Writing 1',
                'level' => '3.5',
                'date' => '2025-02-14',
            ],
            [
                'id' => 'E00002',
                'name' => 'Reading 1',
                'level' => '3.5',
                'date' => '2025-02-21',
            ],
            [
                'id' => 'E00003',
                'name' => 'Listening 1',
                'level' => '4.0',
                'date' => '2025-02-28',
            ],
        ];
        return view('teacher.correction--homeworks', compact('id', 'exercises'));
    }

    public function correctionTest($id)
    {
        $exercises = [
            [
                'id' => 'E00001',
                'name' => 'Writing 1',
                'level' => '3.5',
                'date' => '2025-02-14',
            ],
            [
                'id' => 'E00002',
                'name' => 'Reading 1',
                'level' => '3.5',
                'date' => '2025-02-21',
            ],
            [
                'id' => 'E00003',
                'name' => 'Listening 1',
                'level' => '4.0',
                'date' => '2025-02-28',
            ],
        ];
        return view('teacher.correction--tests', compact('id', 'exercises'));
    }

    public function correctionHomeworkView($id, $homeworkId)
    {
        $students = [
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tiến Dũng',
                'gender' => 'Male',
                'birth_date' => '2003-05-25',
                'score' => '10.0',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Minh Đức',
                'gender' => 'Male',
                'birth_date' => '2002-02-02',
                'score' => '9.0',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trần Thu Hà',
                'gender' => 'Female',
                'birth_date' => '2006-12-15',
                'score' => '8.0',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Duy Hoàng',
                'gender' => 'Male',
                'birth_date' => '2004-09-28',
                'score' => 'N/A',
            ],
            [
                'id' => 'S00236',
                'name' => 'Phạm Anh Kiên',
                'gender' => 'Male',
                'birth_date' => '2009-01-24',
                'score' => 'N/A',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tấn Lộc',
                'gender' => 'Male',
                'birth_date' => '2005-08-14',
                'score' => 'N/A',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Nam Phong',
                'gender' => 'Male',
                'birth_date' => '2006-09-23',
                'score' => 'N/A',
            ],
        ];
        return view('teacher.correction--homeworks-view', compact('id', 'homeworkId', 'students'));
    }

    public function correctionTestView($id, $homeworkId)
    {
        $students = [
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tiến Dũng',
                'gender' => 'Male',
                'birth_date' => '2003-05-25',
                'score' => '10.0',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Minh Đức',
                'gender' => 'Male',
                'birth_date' => '2002-02-02',
                'score' => '9.0',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trần Thu Hà',
                'gender' => 'Female',
                'birth_date' => '2006-12-15',
                'score' => '8.0',
            ],
            [
                'id' => 'S00236',
                'name' => 'Trịnh Duy Hoàng',
                'gender' => 'Male',
                'birth_date' => '2004-09-28',
                'score' => 'N/A',
            ],
            [
                'id' => 'S00236',
                'name' => 'Phạm Anh Kiên',
                'gender' => 'Male',
                'birth_date' => '2009-01-24',
                'score' => 'N/A',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Tấn Lộc',
                'gender' => 'Male',
                'birth_date' => '2005-08-14',
                'score' => 'N/A',
            ],
            [
                'id' => 'S00236',
                'name' => 'Nguyễn Nam Phong',
                'gender' => 'Male',
                'birth_date' => '2006-09-23',
                'score' => 'N/A',
            ],
        ];
        return view('teacher.correction--tests-view', compact('id', 'homeworkId', 'students'));
    }

    public function correctionHomeworkScoring($id, $homeworkId, $studentId)
    {
        if (request()->isMethod('post')) {
            return redirect("/correction/$id/homeworks/$homeworkId");
        }
        return view('teacher.correction--homeworks-scoring', compact('id', 'homeworkId', 'studentId'));
    }

    public function correctionTestScoring($id, $homeworkId, $studentId)
    {
        if (request()->isMethod('post')) {
            return redirect("/correction/$id/tests/$homeworkId");
        }
        return view('teacher.correction--tests-scoring', compact('id', 'homeworkId', 'studentId'));
    }
}
