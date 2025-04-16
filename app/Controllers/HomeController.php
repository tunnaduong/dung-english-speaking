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
use App\Models\ReadingAnswer;
use App\Models\WritingAnswer;
use App\Controllers\Controller;
use App\Models\ListeningAnswer;

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
  public $writingAnswer;
  public $readingAnswer;
  public $listeningAnswer;

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
    $this->writingAnswer = new WritingAnswer();
    $this->readingAnswer = new ReadingAnswer();
    $this->listeningAnswer = new ListeningAnswer();
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
      $courses = $this->infoEmployee::query()
        ->select([
          'class.*',
          'info_employee.*',
          'c.*', // Alias for the course table
          'COUNT(class.id) AS total_classes',
          'c.id AS co_id',
          'class.id AS c_id'
        ])
        ->join('class', 'class.teacher_id = info_employee.id', 'INNER') // Join with the class table
        ->join('course', 'class.id_course = c.id', 'INNER', 'c') // Alias the course table as 'c'
        ->where('info_employee.id', '=', session('user')['user_id']) // Filter by teacher ID
        ->groupBy(['c.id', 'c.course_name']) // Group by course ID and course name
        ->get();
      if (request()->input('search')) {
        $courses = $this->infoEmployee->select([
          'class.*',
          'info_employee.*',
          'c.*', // Alias for the course table
          'COUNT(class.id) AS total_classes',
          'c.id AS co_id',
          'class.id AS c_id'
        ])
          ->join('class', 'class.teacher_id = info_employee.id', 'INNER') // Join with the class table
          ->join('course', 'class.id_course = c.id', 'INNER', 'c') // Alias the course table as 'c'
          ->where('info_employee.id', '=', session('user')['user_id']) // Filter by teacher ID
          ->groupBy(['c.id', 'c.course_name'])
          ->where('course_name', 'LIKE', "%" . request()->input('search') . "%")
          ->get();
      }
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
      if (request()->input('search')) {
        $exercises = $this->exercise->orWhere('name', 'LIKE', "%" . request()->input('search') . "%")
          ->orWhere('skill_type', 'LIKE', "%" . request()->input('search') . "%")
          ->orWhere('type', 'LIKE', "%" . request()->input('search') . "%")
          ->get();
      }
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
          $homeworks = $this->result->getWritingHomeworks(session('user')['user_id']);
          break;
        case 'listening':
          $homeworks = $this->result->getListeningHomeworks(session('user')['user_id']);
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
        $homework = $this->homework->getReadingHomeworkById($id);
        return view('exercises.homework--start-reading', compact('id', 'homework'));
        break;
      case 'Writing':
        $homework = $this->homework->getWritingHomeworkById($id);
        if (!isset($_SESSION['writing_start_time'][$id])) {
          $_SESSION['writing_start_time'][$id] = time();
        }

        $start_time = $_SESSION['writing_start_time'][$id];
        $current_time = time();

        $max_time = $homework['time_do_test']; // phút
        $time_left = null;

        if ($max_time !== null) {
          $time_left = max(0, $max_time * 60 - ($current_time - $start_time));
        }
        return view('exercises.homework--start-writing', compact('id', 'homework', 'time_left', 'max_time'));
        break;
      case 'Listening':
        $homework = $this->homework->getListeningHomeworkById($id);
        return view('exercises.homework--start-listening', compact('id', 'homework'));
        break;
    }
  }

  public function convertToHours($time)
  {
    // Split the input time into minutes and seconds
    list($minutes, $seconds) = explode(':', $time);

    // Calculate hours, minutes, and seconds
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;

    // Format the time as hh:mm:ss
    return sprintf('%02d:%02d:%02d', $hours, $remainingMinutes, $seconds);
  }

  public function submitWritingHomework($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }

    $homework = $this->homework->getWritingHomeworkById($id);
    $this->writingAnswer->create([
      'exercise_id' => $id,
      'student_id' => session('user')['user_id'],
      'topic_id' => $homework['topic_id'],
      'content' => request()->input('content'),
      'time_spent' => $this->convertToHours(request()->input('time_spent')),
      'word_count' => request()->input('word_count'),
    ]);
    $this->result->create([
      'student_id' => session('user')['user_id'],
      'exercise_id' => $id,
      'time_spent' => $this->convertToHours(request()->input('time_spent')),
    ]);
    unset($_SESSION['writing_start_time'][$id]);
    return redirect('/exercises/homeworks?type=writing');
  }

  public function submitReadingHomework($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $homework = $this->homework->getReadingHomeworkById($id);
    $resultId = $this->result->create([
      'student_id' => session('user')['user_id'],
      'exercise_id' => $id,
      'total_questions' => $homework['number_of_answers'],
      'time_spent' => request()->input('time_spent'),
    ]);
    foreach (request()->input('answers') as $questionNumber => $answerText) {
      $this->readingAnswer::create([
        'student_id' => session('user')['user_id'],
        'exercise_id' => $id,
        'topic_id' => $homework['topic_id'],
        'result_id' => $resultId,
        'question_number' => $questionNumber,
        'answer_text' => trim($answerText),
      ]);
    }
    return redirect('/exercises/homeworks?type=reading');
  }

  public function submitListeningHomework($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $homework = $this->homework->getListeningHomeworkById($id);
    $resultId = $this->result->create([
      'student_id' => session('user')['user_id'],
      'exercise_id' => $id,
      'total_questions' => $homework['number_of_answers'],
      'time_spent' => request()->input('time_spent'),
    ]);
    foreach (request()->input('answers') as $questionNumber => $answerText) {
      $this->listeningAnswer::create([
        'student_id' => session('user')['user_id'],
        'exercise_id' => $id,
        'topic_id' => $homework['topic_id'],
        'result_id' => $resultId,
        'question_number' => $questionNumber,
        'answer_text' => trim($answerText),
      ]);
    }
    return redirect('/exercises/homeworks?type=listening');
  }

  public function test()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $tests = $this->result->getReadingTests(session('user')['user_id']);
    if (request()->input('type')) {
      switch (request()->input('type')) {
        case 'reading':
          $tests = $this->result->getReadingTests(session('user')['user_id']);
          break;
        case 'writing':
          $tests = $this->result->getWritingTests(session('user')['user_id']);
          break;
        case 'listening':
          $tests = $this->result->getListeningTests(session('user')['user_id']);
          break;
      }
    }
    return view('exercises.test', compact('tests'));
  }

  public function doTest($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $exercise = $this->homework->find(['id' => $id]);
    switch ($exercise['skill_type']) {
      case 'Reading':
        $test = $this->homework->getReadingTestById($id);
        return view('exercises.test--start-reading', compact('id', 'test'));
        break;
      case 'Writing':
        $test = $this->homework->getWritingTestById($id);
        if (!isset($_SESSION['writing_start_time'][$id])) {
          $_SESSION['writing_start_time'][$id] = time();
        }

        $start_time = $_SESSION['writing_start_time'][$id];
        $current_time = time();

        $max_time = $test['time_do_test'] ?? null; // phút
        $time_left = null;

        if ($max_time !== null) {
          $time_left = max(0, $max_time * 60 - ($current_time - $start_time));
        }
        return view('exercises.test--start-writing', compact('id', 'test', 'time_left', 'max_time'));
        break;
      case 'Listening':
        $test = $this->homework->getListeningTestById($id);
        return view('exercises.test--start-listening', compact('id', 'test'));
        break;
    }
  }

  public function submitReadingTest($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $homework = $this->homework->getReadingTestById($id);
    $resultId = $this->result->create([
      'student_id' => session('user')['user_id'],
      'exercise_id' => $id,
      'total_questions' => $homework['number_of_answers'],
      'time_spent' => request()->input('time_spent'),
    ]);
    foreach (request()->input('answers') as $questionNumber => $answerText) {
      $this->readingAnswer::create([
        'student_id' => session('user')['user_id'],
        'exercise_id' => $id,
        'topic_id' => $homework['topic_id'],
        'result_id' => $resultId,
        'question_number' => $questionNumber,
        'answer_text' => trim($answerText),
      ]);
    }
    return redirect('/exercises/tests?type=reading');
  }

  public function submitWritingTest($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $homework = $this->homework->getWritingTestById($id);
    $this->writingAnswer->create([
      'exercise_id' => $id,
      'student_id' => session('user')['user_id'],
      'topic_id' => $homework['topic_id'],
      'content' => request()->input('content'),
      'time_spent' => $this->convertToHours(request()->input('time_spent')),
      'word_count' => request()->input('word_count'),
    ]);
    $this->result->create([
      'student_id' => session('user')['user_id'],
      'exercise_id' => $id,
      'time_spent' => $this->convertToHours(request()->input('time_spent')),
    ]);
    unset($_SESSION['writing_start_time'][$id]);
    return redirect('/exercises/tests?type=writing');
  }

  public function submitListeningTest($id)
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    $homework = $this->homework->getListeningTestById($id);
    $resultId = $this->result->create([
      'student_id' => session('user')['user_id'],
      'exercise_id' => $id,
      'total_questions' => $homework['number_of_answers'],
      'time_spent' => request()->input('time_spent'),
    ]);
    foreach (request()->input('answers') as $questionNumber => $answerText) {
      $this->listeningAnswer::create([
        'student_id' => session('user')['user_id'],
        'exercise_id' => $id,
        'topic_id' => $homework['topic_id'],
        'result_id' => $resultId,
        'question_number' => $questionNumber,
        'answer_text' => trim($answerText),
      ]);
    }
    return redirect('/exercises/tests?type=listening');
  }

  public function absence()
  {
    if (session('user')['role'] === 'Teacher' || session('user')['role'] === 'Teaching Assistant') {
      return redirect('/');
    }
    return view('home.absence');
  }
}
