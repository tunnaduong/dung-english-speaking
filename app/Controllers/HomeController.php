<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Exercise;
use App\Models\Homework;

class HomeController extends Controller
{
  public $student;
  public $employee;
  public $course;
  public $homework;
  public $exercise;

  public function __construct()
  {
    $this->student = new Student();
    $this->employee = new Employee();
    $this->course = new Course();
    $this->homework = new Homework();
    $this->exercise = new Exercise();
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

  public function courses()
  {
    $courses = $this->course::getCoursesByStudentId(session('user')['user_id']);
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return view('teacher.courses', compact('courses'));
    }
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
    $homeworks = $this->homework->getHomeworks();
    return view('exercises.homework', compact('homeworks'));
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
