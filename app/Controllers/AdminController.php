<?php

namespace App\Controllers;

use App\Models\Roles;
use App\Models\Course;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Exercise;
use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\Curriculum;
use App\Models\InfoStudent;
use App\Models\InfoEmployee;

class AdminController extends Controller
{
    public $infoEmployee;
    public $roles;
    public $employee;
    public $schedule;
    public $student;
    public $infoStudent;
    public $course;
    public $classroom;
    public $exercise;
    public $curriculum;

    public function __construct()
    {
        $this->infoEmployee = new InfoEmployee();
        $this->roles = new Roles();
        $this->employee = new Employee();
        $this->schedule = new Schedule();
        $this->student = new Student();
        $this->infoStudent = new InfoStudent();
        $this->course = new Course();
        $this->classroom = new Classroom();
        $this->exercise = new Exercise();
        $this->curriculum = new Curriculum();
    }

    public function employees()
    {
        $employees = $this->infoEmployee->join('roles', 'info_employee.role_id = roles.role_id', 'INNER')
            ->paginate();
        if (request()->get('search')) {
            $employees = $this->infoEmployee
                ->where('name', 'LIKE', '%' . request()->get('search') . '%')
                ->paginate();
        }
        return view('admin.employees', compact('employees'));
    }

    public function addEmployee()
    {
        if (request()->isMethod('post')) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'personal_id' => 'required|min:8|max:12',
                'DoB' => 'required',
                'address' => 'required',
                'phone' => 'required|min:10|max:11',
                'role_id' => 'required',
            ];

            if (!request()->validate($rules, $_POST)) {
                return back();
            }

            $data = request()->post();

            $data['status'] = 'Working';

            $email = $data['email'];

            // Remove the 'email' field from the $data array
            unset($data['email']);
            unset($data['address']);

            $uid = $this->infoEmployee->create($data);
            $this->employee->create([
                'user_id' => $uid,
                'email' => $email,
                'password' => '123',
            ]);
            return redirect('/employees');
        }
        $roles = $this->roles->all();
        return view('admin.employees--add', compact('roles'));
    }

    public function editEmployee($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $email = $data['email'];
            unset($data['email']);
            unset($data['address']);
            $this->employee->update(['email' => $email], ['user_id' => $id]);
            $this->infoEmployee->update($data, ['id' => $id]);
            return redirect('/employees');
        }
        $employee = $this->infoEmployee->find(['id' => $id]);
        $emp = $this->employee->find(['user_id' => $id]);
        $roles = $this->roles->all();
        return view('admin.employees--edit', compact('employee', 'emp', 'id', 'roles'));
    }

    public function deleteEmployee($id)
    {
        $this->infoEmployee->delete(['id' => $id]);
        return redirect('/employees');
    }

    public function schoolShift()
    {
        $shifts = $this->schedule->all();
        if (request()->get('search')) {
            $shifts = $this->schedule->where('day_of_week', 'LIKE', '%' . request()->get('search') . '%')
                ->get();
        }
        return view('admin.school-shift', compact('shifts'));
    }

    public function addSchoolShift()
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'start_time' => 'required',
                'end_time' => 'required',
                'day_of_week' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->schedule->create($data);
            return redirect('/school-shift');
        }
        return view('admin.school-shift--add');
    }

    public function editSchoolShift($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'start_time' => 'required',
                'end_time' => 'required',
                'day_of_week' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->schedule->update($data, ['id' => $id]);
            return redirect('/school-shift');
        }
        $shift = $this->schedule->find(['id' => $id]);
        return view('admin.school-shift--edit', compact('shift'));
    }

    public function deleteSchoolShift($id)
    {
        $this->schedule->delete(['id' => $id]);
        return redirect('/school-shift');
    }

    public function addStudent($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'DoB' => 'required',
                'phone' => 'required|min:10|max:11',
                'password' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $data['class_id'] = $id;
            $email = $data['email'];
            $password = $data['password'];
            unset($data['email']);
            unset($data['password']);
            $uid = $this->infoStudent->create($data);
            $this->student->create([
                'student_id' => $uid,
                'email' => $email,
                'password' => $password,
            ]);
            return redirect('/classrooms/' . $id . '/list');
        }
        return view('admin.classrooms--list--add-student', compact('id'));
    }

    public function editStudent($id)
    {
        return view('admin.classrooms--list--edit-student', compact('id'));
    }

    public function deleteStudent($id)
    {
        $this->infoStudent->delete(['id' => $id]);
        return back();
    }

    public function assignClassroom($id)
    {
        $class = $this->classroom->find(['id' => $id]);
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'teacher_id' => 'required',
                'assistant_id' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $class['teacher_id'] = $data['teacher_id'];
            $class['assistant_id'] = $data['assistant_id'];
            $this->classroom->update($class, ['id' => $id]);
            return redirect('/classrooms');
        }
        $course = $this->course->getCourseByClassId($id);
        $class = $this->classroom->find(['id' => $id]);
        $teachers = $this->infoEmployee->all(['role_id' => 1]);
        $tas = $this->infoEmployee->all(['role_id' => 2]);
        return view('admin.classrooms--assign', compact('id', 'course', 'teachers', 'tas', 'class'));
    }

    public function editStudents($id)
    {
        $student = $this->infoStudent->getStudentById($id);
        $classes = $this->classroom->all();
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'DoB' => 'required',
                'phone' => 'required|min:10|max:11',
                'password' => 'required',
                'class_id' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $email = $data['email'];
            $password = $data['password'];
            unset($data['email']);
            unset($data['password']);
            $this->infoStudent->update($data, ['id' => $id]);
            $this->student->update([
                'email' => $email,
                'password' => $password,
            ], ['student_id' => $id]);
            return redirect('/students');
        }
        return view('admin.students--edit', compact('id', 'student', 'classes'));
    }

    public function addStudents()
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'DoB' => 'required',
                'phone' => 'required|min:10|max:11',
                'password' => 'required',
                'class_id' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $email = $data['email'];
            $password = $data['password'];
            unset($data['email']);
            unset($data['password']);
            $uid = $this->infoStudent->create($data);
            $this->student->create([
                'student_id' => $uid,
                'email' => $email,
                'password' => $password,
            ]);
            return redirect('/students');
        }
        $classes = $this->classroom->all();
        return view('admin.students--add', compact('classes'));
    }

    public function deleteCourse($id)
    {
        $this->course->delete(['id' => $id]);
        return redirect('/courses');
    }

    public function addCourse()
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'course_name' => 'required',
                'NoL' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $data['created_by'] = session('user')['user_id'];
            $this->course->create($data);
            return redirect('/courses');
        }
        return view('admin.courses--add');
    }

    public function courseCurriculum($id)
    {
        $course = $this->course->getCourseByClassId($id);
        $curriculums = $this->curriculum::query()
            ->select([
                'curriculum.*',
                'curriculum.id AS c_id',
                'curriculum.created_at AS c_created_at',
                'c.*'
            ])
            ->join('course', 'c.id = curriculum.course_id', 'INNER', 'c')
            ->where('c.id', '=', $id)
            ->paginate();
        if (request()->get('search')) {
            $curriculums = $this->curriculum::query()
                ->select([
                    'curriculum.*',
                    'curriculum.id AS c_id',
                    'curriculum.created_at AS c_created_at',
                    'c.*'
                ])
                ->join('course', 'c.id = curriculum.course_id', 'INNER', 'c')
                ->where('c.id', '=', $id)
                ->where('topic', 'LIKE', '%' . request()->get('search') . '%')
                ->paginate();
        }

        return view('admin.courses--curriculum', compact('curriculums', 'course', 'id'));
    }

    public function addCurriculum($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'topic' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $data['course_id'] = $id;
            $this->curriculum->create($data);
            return redirect('/courses/' . $id . '/curriculum');
        }
        $course = $this->course->getCourseByClassId($id);
        $exercises = $this->exercise::all();
        return view('admin.courses--curriculum-add', compact('id', 'course', 'exercises'));
    }

    public function editCurriculum($id, $curriculumId)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'topic' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            // Convert date "" thành NULL trước khi lưu
            if ($data['date'] == "") {
                $data['date'] = null;
            }
            if ($data['exercise_id'] == "") {
                $data['exercise_id'] = null;
            }
            $this->curriculum->update($data, ['id' => $curriculumId]);
            return redirect('/courses/' . $id . '/curriculum');
        }
        $curriculum = $this->course->find(['id' => $curriculumId]);
        $course2 = $this->course->getCourseByClassId($id);
        $exercises = $this->exercise::all();
        $course = $this->curriculum::find(['id' => $curriculumId]);
        return view('admin.courses--curriculum-edit', compact('id', 'curriculum', 'curriculumId', 'course2', 'exercises', 'course'));
    }

    public function deleteCurriculum($id, $curriculumId)
    {
        $this->curriculum->delete(['id' => $curriculumId]);
        return redirect('/courses/' . $id . '/curriculum');
    }

    public function account()
    {
        $accounts_employee = $this->infoEmployee->join('roles', 'info_employee.role_id = roles.role_id', 'INNER')
            ->get();
        $accounts_student = $this->infoStudent->all();
        if (request()->get('search')) {
            $accounts_employee = $this->infoEmployee
                ->where('name', 'LIKE', '%' . request()->get('search') . '%')
                ->join('roles', 'info_employee.role_id = r.role_id', 'INNER', 'r')
                ->get();
            $accounts_student = $this->infoStudent
                ->where('name', 'LIKE', '%' . request()->get('search') . '%')
                ->get();
        }
        foreach ($accounts_employee as $key => $value) {
            $employee = $this->employee->find(['user_id' => $value['id']]);
            $accounts_employee[$key]['email'] = $employee ? $employee['email'] : null; // Safely handle null
        }
        foreach ($accounts_student as $key => $value) {
            $student = $this->student->find(['student_id' => $value['id']]);
            $accounts_student[$key]['role'] = 'Student';
            $accounts_student[$key]['email'] = $student ? $student['email'] : null; // Safely handle null
        }
        $accounts = array_merge($accounts_employee, $accounts_student);
        return view('admin.account', compact('accounts'));
    }

    public function editEmployeeAccount($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
                'role_id' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->infoEmployee->update(['role_id' => $data['role_id']], ['id' => $id]);
            $this->employee->update(['email' => $data['email'], 'password' => $data['password']], ['user_id' => $id]);
            return redirect('/account');
        }
        $employee = $this->employee->find(['user_id' => $id]);
        $employee2 = $this->infoEmployee->find(['id' => $id]);
        $roles = $this->roles->all();
        return view('admin.account--edit-employee', compact('employee', 'employee2', 'id', 'roles'));
    }

    public function editStudentAccount($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->student->update(['email' => $data['email'], 'password' => $data['password']], ['student_id' => $id]);
            return redirect('/account');
        }
        $student = $this->student->find(['student_id' => $id]);
        $student2 = $this->infoStudent->find(['id' => $id]);
        return view('admin.account--edit-student', compact('student', 'id', 'student2'));
    }

    public function deleteStudentAccount($id)
    {
        $this->infoStudent->delete(['id' => $id]);
        return redirect('/account');
    }

    public function deleteEmployeeAccount($id)
    {
        $this->infoEmployee->delete(['id' => $id]);
        return redirect('/account');
    }

    public function editClassroom($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'class_name' => 'required',
                'id_course' => 'required',
                'NoS' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'teacher_id' => 'required',
                'assistant_id' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->classroom->update($data, ['id' => $id]);
            return redirect('/classrooms');
        }
        $classroom = $this->classroom->find(['id' => $id]);
        $courses = $this->course->all();
        $course = $this->course->getCourseByClassId($id);
        $teachers = $this->infoEmployee->all(['role_id' => 1]);
        $tas = $this->infoEmployee->all(['role_id' => 2]);
        return view('admin.classrooms--edit', compact('classroom', 'course', 'courses', 'id', 'teachers', 'tas'));
    }

    public function addClassroom()
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'class_name' => 'required',
                'id_course' => 'required',
                'NoS' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'teacher_id' => 'required',
                'assistant_id' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->classroom->create($data);
            return redirect('/classrooms');
        }
        $courses = $this->course->all();
        $teachers = $this->infoEmployee->all(['role_id' => 1]);
        $tas = $this->infoEmployee->all(['role_id' => 2]);
        return view('admin.classrooms--add', compact('courses', 'teachers', 'tas'));
    }

    public function deleteClassroom($id)
    {
        $this->classroom->delete(['id' => $id]);
        return redirect('/classrooms');
    }
}
