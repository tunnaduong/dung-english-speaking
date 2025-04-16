<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Exercise;
use App\Models\Homework;
use App\Models\InfoStudent;
use App\Models\InfoEmployee;
use App\Controllers\Controller;

class HomeController extends Controller
{
  public $student;
  public $employee;
  public $course;
  public $homework;
  public $exercise;
  public $infoStudent;
  public $infoEmployee;
  public $result;

  public function __construct()
  {
    $this->student = new Student();
    $this->employee = new Employee();
    $this->course = new Course();
    $this->homework = new Homework();
    $this->exercise = new Exercise();
    $this->infoStudent = new InfoStudent();
    $this->infoEmployee = new InfoEmployee();
    $this->result = new Result();
    if (!session('user')) {
      redirect('/login');
    }
  }

  public function index()
  {
    if (!session('user')) {
      return redirect('/login');
    }
    if (session('user')['role'] === 'Academic Affair') {
      return redirect('/classrooms');
    }
    return redirect('/profile');
  }

  public function profile()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      $profile = $this->employee->findByEmail(session('user')['email']);
      return view('teacher.profile', compact('profile'));
    }
    $profile = $this->student->findByEmail(session('user')['email']);
    return view('home.profile', compact('profile'));
  }

  public function updateProfile()
  {
    if (session('user')['role'] === 'Student') {
      $this->infoStudent::update([
        'name' => request()->input('full_name'),
        'DoB' => request()->input('dob'),
      ], [
        'id' => session('user')['user_id']
      ]);
    } else {
      $this->infoEmployee::update([
        'name' => request()->input('full_name'),
        'DoB' => request()->input('dob'),
      ], [
        'id' => session('user')['user_id']
      ]);
    }
    // Retrieve the current session data
    $currentUser = session('user');
    // Update only the 'name' field
    $currentUser['name'] = request()->input('full_name');
    // Save the updated session data back
    session_set('user', $currentUser);
    return redirect('/profile');
  }

  public function courses()
  {
    if (session('user')['role'] === 'Academic Affair') {
      $courses = $this->course->getAllCoursesInAdmin();
      if (request()->input('search')) {
        $courses = $this->course::searchCoursesByName(request()->input('search'));
      }
      return view('admin.courses', compact('courses'));
    }
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      $courses = $this->course::getCoursesByTeacherId(session('user')['user_id']);
      return view('teacher.courses', compact('courses'));
    }
    $courses = $this->course::getCoursesByStudentId(session('user')['user_id']);
    return view('home.courses', compact('courses'));
  }

  public function courseDetail($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $courseContent = $this->course->getCourseContent($id);
    return view('courses.detail', compact('courseContent'));
  }

  public function exercise()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      $exercises = $this->exercise::all();
      return view('teacher.exercises', compact('exercises'));
    }
    return view('home.exercise');
  }

  public function homework()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $homeworks = $this->result->getReadingHomeworks(session('user')['user_id']);
    if (request()->input('type')) {
      switch (request()->input('type')) {
        case 'reading':
          $homeworks = $this->result->getReadingHomeworks(session('user')['user_id']);
          break;
        case 'writing':
          $homeworks = $this->result->getWritingHomeworks(session('user')['user_id'], 1);
          break;
        case 'listening':
          $homeworks = $this->result->getListeningHomeworks(session('user')['user_id'], 0);
          break;
      }
    }
    return view('exercises.homework', compact('homeworks'));
  }

  public function doHomework($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $exercise = $this->homework->find(['id' => $id]);
    switch ($exercise['skill_type']) {
      case 'Reading':
        return view('exercises.homework--start-reading', compact('id'));
        break;
      case 'Writing':
        $homework = $this->homework->getWritingHomeworkById($id);
        return view('exercises.homework--start-writing', compact('id', 'homework'));
        break;
      case 'Listening':
        break;
    }
    return view('exercises.homework--start-writing', compact('id'));
  }

  public function test()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $tests = $this->homework->getTests();
    return view('exercises.test', compact('tests'));
  }

  public function absence()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    return view('home.absence');
  }
}
