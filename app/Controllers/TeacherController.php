<?php

namespace App\Controllers;

use App\Core\Asset\Asset;
use App\Models\Attendance;
use App\Models\ClassProgress;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\Classroom;
use App\Models\Curriculum;
use App\Models\InfoStudent;
use App\Models\ListeningQuestion;
use App\Models\ListeningTopic;
use App\Models\ReadingQuestion;
use App\Models\ReadingTopic;
use App\Models\Student;
use App\Models\WritingTopic;

class TeacherController extends Controller
{
    public $classroom;
    public $studentInfo;
    public $course;
    public $curriculum;
    public $exercise;

    public function __construct()
    {
        $this->studentInfo = new InfoStudent();
        $this->classroom = new Classroom();
        $this->course = new Course();
        $this->curriculum = new Curriculum();
        $this->exercise = new Exercise();
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
            $classrooms = $this->classroom->select(['class.id AS class_id', 'class.*', 'info_employee.*', 'course.*'])
                ->join('info_employee', 'class.teacher_id = info_employee.id', 'INNER')
                ->join('course', 'class.id_course = course.id', 'INNER')
                ->get();
            if (request()->get('search')) {
                $classrooms = $this->classroom->where('class_name', 'LIKE', "%" . request()->get('search') . "%")->get();
            }
            return view('admin.classrooms', compact('classrooms'));
        }
        $classrooms = $this->classroom->select(['class.id AS class_id', 'class.*', 'info_employee.*', 'course.*'])->orWhere('assistant_id', '=', session('user')['user_id'])->orWhere('teacher_id', '=', session('user')['user_id'])
            ->join('info_employee', 'class.teacher_id = info_employee.id', 'INNER')
            ->join('course', 'class.id_course = course.id', 'INNER')
            ->get();
        if (request()->get('search')) {
            $classrooms = $this->classroom->where('class_name', 'LIKE', "%" . request()->get('search') . "%")->get();
        }
        return view('teacher.classrooms', compact('classrooms'));
    }

    public function classroomList($id)
    {
        $students = $this->studentInfo->where('class_id', '=', $id)->paginate();
        if (request()->get('search')) {
            $students = $this->studentInfo->where('class_id', '=', $id)->where('name', 'LIKE', "%" . request()->get('search') . "%")->paginate();
        }
        $course = $this->course->getCourseByClassId($id);
        if (session('user')['role'] === 'Academic Affair') {
            return view('admin.classrooms--list', compact('students', 'course', 'id'));
        }
        return view('teacher.classroom-list', compact('students', 'id', 'course'));
    }

    public function classroomCurriculum($id)
    {
        if (session('user')['role'] === 'Academic Affair') {
            $course = $this->course->getCourseByClassId($id);
            $curriculums = $this->course
                ->select(['course.*', 'curriculum.*', 'curriculum.id AS c_id', 'curriculum.created_at AS c_created_at'])
                ->join('curriculum', 'curriculum.course_id = course.id', 'INNER')
                ->where('course_id', '=', $id)
                ->paginate();
            if (request()->get('search')) {
                $curriculums = $this->course
                    ->where('topic', 'LIKE', "%" . request()->get('search') . "%")
                    ->paginate();
            }
            return view('admin.classrooms--curriculum', compact('curriculums', 'id', 'course'));
        }
        $course = $this->course->getCourseByClassId($id);
        $curriculums = $this->course->getCourseContent($id);
        return view('teacher.classroom-curriculum', compact('curriculums', 'id', 'course'));
    }

    public function classroomAttendance($id)
    {
        $days = ClassProgress::query()
            ->where('class_id', '=', $id)
            ->orderBy('date')
            ->get();

        $students = InfoStudent::query()
            ->where('class_id', '=', $id)
            ->get();

        $classProgressIds = [];
        foreach ($days as $day) {
            $classProgressIds[] = $day['id']; // nếu dùng array, dùng ->id nếu là object
        }

        $allAttendances = Attendance::query()->get();

        $attendances = [];
        foreach ($allAttendances as $att) {
            if (in_array($att['class_progress_id'], $classProgressIds)) {
                $key = $att['student_id'] . '_' . $att['class_progress_id'];
                $attendances[$key] = $att;
            }
        }

        $studentData = [];

        foreach ($students as $student) {
            $row = [
                'student_id' => $student['id'],
                'name' => $student['name'],
                'days' => [],
            ];

            foreach ($days as $index => $day) {
                $key = $student['id'] . '_' . $day['id'];
                $attendance = $attendances[$key] ?? null;

                if ($attendance) {
                    switch ($attendance['status']) {
                        case 'absent':
                            $row['days'][] = 'Vắng';
                            break;
                        case 'late':
                            $row['days'][] = 'Đi muộn';
                            break;
                        case 'present':
                            $row['days'][] = 'Có';
                            break;
                        case 'excused':
                            $row['days'][] = 'Có phép';
                            break;
                        default:
                            $row['days'][] = $attendance['status'];
                            break;
                    }
                } else {
                    $row['days'][] = 'Có'; // Mặc định nếu không có điểm danh
                }
            }

            $studentData[] = $row;
        }

        $course = Course::getCourseByClassId($id);

        return view('teacher.classroom-attendance', compact('studentData', 'id', 'course'));
    }

    public function submitAttendance($id)
    {
        $attendanceData = request()->input('attendance', []);

        if (empty($attendanceData)) {
            echo "Không có dữ liệu điểm danh.";
            return;
        }

        // Lấy toàn bộ các buổi học (class_progress) đã có để map vào từng buổi (day_1 => id)
        $progressList = ClassProgress::query()
            ->where('class_id', '=', $id)
            ->orderBy('date')
            ->get();

        // Tạo map: day_1 => class_progress_id
        $dayMap = [];
        foreach ($progressList as $index => $progress) {
            $dayMap['day_' . ($index + 1)] = $progress['id'];
        }

        // Tạo mới nếu chưa có buổi học nào hôm nay
        if (count($dayMap) === 0 || !in_array(date('Y-m-d'), array_column($progressList, 'date'))) {
            $newProgressId = ClassProgress::query()->create([
                'class_id' => $id,
                'date' => date('Y-m-d'),
            ]);
            $dayMap['day_' . (count($dayMap) + 1)] = $newProgressId;
        }

        // Duyệt qua từng học viên và từng buổi học
        foreach ($attendanceData as $studentId => $days) {
            foreach ($days as $dayKey => $status) {
                $classProgressId = $dayMap[$dayKey] ?? null;

                if ($classProgressId && in_array($status, ['present', 'absent', 'late', 'excused'])) {
                    Attendance::query()->create([
                        'student_id' => $studentId,
                        'class_progress_id' => $classProgressId,
                        'status' => $status,
                        'created_by' => $_SESSION['user']['user_id'] ?? null,
                    ]);
                }
            }
        }


        return redirect("/classrooms/$id/attendance");
    }


    public function editCurriculum($id, $curriculumId)
    {
        if (request()->isMethod('post')) {
            // Handle edit curriculum
            $this->curriculum::update([
                'topic' => request()->input('topic'),
                'exercise_id' => request()->input('exercise') ?? null,
                'date' => !empty(request()->input('date')) ? request()->input('date') : null,
                'course_id' => $id,
                'created_by' => session('user')['user_id'],
            ], ['id' => $curriculumId]);
            return redirect("/classrooms/$id/curriculum");
        }
        $course2 = $this->course->getCourseByClassId($id);
        $exercises = $this->exercise::all();
        $course = $this->curriculum::find(['id' => $curriculumId]);
        if (session('user')['role'] === 'Academic Affair') {
            return view('admin.classrooms--curriculum-edit', compact('id', 'curriculumId', 'course', 'course2', 'exercises'));
        }
        return view('teacher.edit-curriculum', compact('id', 'curriculumId', 'course', 'course2', 'exercises'));
    }

    public function deleteCurriculum($id, $curriculumId)
    {
        $this->curriculum::delete(['id' => $curriculumId]);
        return redirect("/classrooms/$id/curriculum");
    }

    public function addCurriculum($id)
    {
        if (request()->isMethod('post')) {
            // Handle add curriculum
            $this->curriculum::create([
                'topic' => request()->input('topic'),
                'date' => request()->input('date'),
                'exercise_id' => request()->input('exercise') ?? null,
                'course_id' => $id,
                'created_by' => session('user')['user_id'],
            ]);
            return redirect("/classrooms/$id/curriculum");
        }
        $course = $this->course->getCourseByClassId($id);
        $exercises = $this->exercise::all();
        return view('teacher.add-curriculum', compact('id', 'exercises', 'course'));
    }

    public function editCourse($id)
    {
        if (session('user')['role'] === 'Academic Affair') {
            $course = $this->course::find(['id' => $id]);
            if (request()->isMethod('post')) {
                // Handle edit course
                preg_match('/\b(\d+)\s+lectures\b/', request()->input('name'), $matches);
                preg_match('/^(.*?)\s*-\s*\d+\s+lectures$/', request()->input('name'), $matches2);
                !empty($matches[1]) ? $nol = $matches[1] : $nol = 0;
                !empty($matches2[1]) ? $name = $matches2[1] : $name = '';
                $this->course::update([
                    'course_name' => $name,
                    'NoL' => $nol,
                    'updated_by' => session('user')['user_id'],
                ], ['id' => $id]);
                return redirect("/courses");
            }
            return view('admin.courses--edit', compact('id', 'course'));
        }
        if (request()->isMethod('post')) {
            // Handle edit course
            preg_match('/\b(\d+)\s+lectures\b/', request()->input('name'), $matches);
            preg_match('/^(.*?)\s*-\s*\d+\s+lectures$/', request()->input('name'), $matches2);
            !empty($matches[1]) ? $nol = $matches[1] : $nol = 0;
            !empty($matches2[1]) ? $name = $matches2[1] : $name = '';
            $this->course::update([
                'course_name' => $name,
                'NoL' => $nol,
                'updated_by' => session('user')['user_id'],
            ], ['id' => $id]);
            return redirect("/courses");
        }
        $course = $this->course::find(['id' => $id]);
        return view('teacher.edit-course', compact('id', 'course'));
    }

    public function students()
    {
        $students = $this->studentInfo->select(['info_student.id AS s_id', 'students.*', 'info_student.*', 'class.*'])
            ->join('class', 'info_student.class_id = class.id', 'INNER')
            ->join('students', 'info_student.id = students.student_id', 'LEFT')
            ->paginate();
        // if has search query
        if (request()->get('search')) {
            $students = $this->studentInfo
                ->orWhere('name', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('phone', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('email', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('class_name', 'LIKE', "%" . request()->get('search') . "%")
                ->paginate();
        }
        if (session('user')['role'] === 'Academic Affair') {
            return view('admin.students', compact('students'));
        }
        return view('teacher.students', compact('students'));
    }

    public function studentProfile($id)
    {
        $student = $this->studentInfo::getStudentById($id);
        $class = $this->classroom::find(['id' => $student['class_id']]);
        return view('teacher.student-profile', compact('id', 'student', 'class'));
    }

    public function studentProfileClassDetail($id, $classId)
    {
        $student = $this->studentInfo::getStudentById($id);
        $class = $this->classroom::find(['id' => $student['class_id']]);
        return view('teacher.student-profile-class-detail', compact('id', 'classId', 'student', 'class'));
    }

    public function correction()
    {
        $classrooms = $this->classroom->select(['class.id AS class_id', 'class.*', 'info_employee.*', 'course.*'])
            ->orWhere('assistant_id', '=', session('user')['user_id'])
            ->orWhere('teacher_id', '=', session('user')['user_id'])
            ->join('info_employee', 'class.teacher_id = info_employee.id', 'INNER')
            ->join('course', 'class.id_course = course.id', 'INNER')
            ->get();
        if (request()->get('search')) {
            $classrooms = $this->classroom->where('class_name', 'LIKE', "%" . request()->get('search') . "%")->get();
        }
        return view('teacher.correction', compact('classrooms'));
    }

    public function createExercise()
    {
        if (request()->isMethod('post')) {
            switch (request()->input('skill')) {
                case 'writing':
                    $exerciseId = $this->exercise::create([
                        'name' => request()->input('name'),
                        'type' => request()->input('type'),
                        'skill_type' => ucfirst(request()->input('skill')),
                        'level' => request()->input('level', ''),
                        'max_score' => 10,
                        'created_by' => session('user')['user_id'],
                    ]);
                    $topicId = WritingTopic::create([
                        'exercise_id' => $exerciseId,
                        'topic' => request()->input('topic'),
                        'level' => request()->input('level', ''),
                        'created_by' => session('user')['user_id'],
                    ]);
                    break;
                case 'listening':
                    $audio_url = Asset::uploadFile(request()->file('audio'), 10, ['mp3', 'wav']);
                    if ($audio_url['success'] === false) {
                        return die($audio_url['message']);
                    }
                    $exersiseId = $this->exercise::create([
                        'name' => request()->input('name'),
                        'type' => request()->input('type'),
                        'skill_type' => ucfirst(request()->input('skill')),
                        'level' => request()->input('level', ''),
                        'max_score' => 10,
                        'created_by' => session('user')['user_id'],
                    ]);
                    $topicId = ListeningTopic::create([
                        'exercise_id' => $exersiseId,
                        'title' => request()->input('title'),
                        'content' => request()->input('topic'),
                        'question' => request()->input('question'),
                        'number_of_answers' => count(request()->input('answers')),
                        'audio_url' => $audio_url['fileName'],
                        'created_by' => session('user')['user_id'],
                    ]);
                    foreach (request()->input('answers') as $questionNumber => $answerText) {
                        ListeningQuestion::create([
                            'topic_id' => $topicId,
                            'question_number' => $questionNumber + 1,
                            'answer_key' => $answerText,
                        ]);
                    }
                    break;
                case 'reading':
                    $exersiseId = $this->exercise::create([
                        'name' => request()->input('name'),
                        'type' => request()->input('type'),
                        'skill_type' => ucfirst(request()->input('skill')),
                        'level' => request()->input('level', ''),
                        'max_score' => 10,
                        'created_by' => session('user')['user_id'],
                    ]);
                    $topicId = ReadingTopic::create([
                        'exercise_id' => $exersiseId,
                        'title' => request()->input('title'),
                        'content' => request()->input('topic'),
                        'question' => request()->input('question'),
                        'number_of_answers' => count(request()->input('answers')),
                        'created_by' => session('user')['user_id'],
                    ]);
                    foreach (request()->input('answers') as $questionNumber => $answerText) {
                        ReadingQuestion::create([
                            'topic_id' => $topicId,
                            'question_number' => $questionNumber + 1,
                            'answer_key' => $answerText,
                        ]);
                    }
                    break;
            }
            return redirect('/exercises');
        }
        if (!request()->get('type')) {
            return redirect('/exercises/create?type=reading');
        }
        switch (request()->input('type')) {
            case 'writing':
                return view('teacher.create-exercise--writing');
            case 'listening':
                return view('teacher.create-exercise--listening');
            case 'reading':
                return view('teacher.create-exercise--reading');
        }
        return view('teacher.create-exercise--reading');
    }

    public function editExercise($id)
    {
        if (request()->isMethod('post')) {
            $exercise = $this->exercise::find(['id' => $id]);
            switch ($exercise['skill_type']) {
                case 'Writing':
                    $topic = WritingTopic::find(['exercise_id' => $id]);
                    $this->exercise::update([
                        'name' => request()->input('name'),
                        'type' => request()->input('type'),
                    ], ['id' => $id]);
                    WritingTopic::update([
                        'topic' => request()->input('topic'),
                    ], ['exercise_id' => $id]);
                    break;
                case 'Listening':
                    if (request()->hasFile('audio')) {
                        $audio_url = Asset::uploadFile(request()->file('audio'), 10, ['mp3', 'wav']);
                        if ($audio_url['success'] === false) {
                            return die($audio_url['message']);
                        }
                        ListeningTopic::update([
                            'audio_url' => $audio_url['fileName'],
                        ], ['exercise_id' => $id]);
                    }
                    $topic = ListeningTopic::find(['exercise_id' => $id]);
                    $this->exercise::update([
                        'name' => request()->input('name'),
                        'type' => request()->input('type'),
                    ], ['id' => $id]);
                    ListeningTopic::update([
                        'title' => request()->input('title'),
                        'content' => request()->input('topic'),
                        'question' => request()->input('question'),
                        'audio_url' => $audio_url['fileName'] ?? $topic['audio_url'],
                        'number_of_answers' => count(request()->input('answers')),
                    ], ['exercise_id' => $id]);
                    // Handle answers
                    $submittedAnswers = request()->input('answers', []); // Submitted answers
                    $existingAnswers = ListeningQuestion::query()->where('topic_id', '=', $topic['id'])->get(); // Existing answers in DB

                    $existingAnswerIds = array_column($existingAnswers, 'id'); // IDs of existing answers
                    $submittedAnswerIds = array_filter(array_column($submittedAnswers, 'id')); // IDs of submitted answers

                    // Update or create answers
                    foreach ($submittedAnswers as $questionNumber => $answerData) {
                        if (isset($answerData) && in_array($questionNumber, $existingAnswerIds)) {
                            // Update existing answer
                            ListeningQuestion::update([
                                'question_number' => $questionNumber + 1,
                                'answer_key' => $answerData,
                            ], ['topic_id' => $topic['id'], 'question_number' => $questionNumber + 1]);
                        } else {
                            // Create new answer
                            ListeningQuestion::create([
                                'topic_id' => $topic['id'],
                                'question_number' => $questionNumber + 1,
                                'answer_key' => $answerData,
                            ]);
                        }
                    }

                    // Delete removed answers
                    $answersToDelete = array_diff($existingAnswerIds, $submittedAnswerIds);
                    foreach ($answersToDelete as $answerId) {
                        ListeningQuestion::delete(['id' => $answerId]);
                    }
                    return redirect('/exercises');
                    break;
                case 'Reading':
                    $topic = ReadingTopic::find(['exercise_id' => $id]);
                    $this->exercise::update([
                        'name' => request()->input('name'),
                        'type' => request()->input('type'),
                    ], ['id' => $id]);
                    ReadingTopic::update([
                        'title' => request()->input('title'),
                        'content' => request()->input('topic'),
                        'question' => request()->input('question'),
                        'number_of_answers' => count(request()->input('answers')),
                    ], ['exercise_id' => $id]);
                    // Handle answers
                    $submittedAnswers = request()->input('answers', []); // Submitted answers
                    $existingAnswers = ReadingQuestion::query()->where('topic_id', '=', $topic['id'])->get(); // Existing answers in DB

                    $existingAnswerIds = array_column($existingAnswers, 'id'); // IDs of existing answers
                    $submittedAnswerIds = array_filter(array_column($submittedAnswers, 'id')); // IDs of submitted answers

                    // Update or create answers
                    foreach ($submittedAnswers as $questionNumber => $answerData) {
                        if (isset($answerData) && in_array($questionNumber, $existingAnswerIds)) {
                            // Update existing answer
                            ReadingQuestion::update([
                                'question_number' => $questionNumber + 1,
                                'answer_key' => $answerData,
                            ], ['topic_id' => $topic['id'], 'question_number' => $questionNumber + 1]);
                        } else {
                            // Create new answer
                            ReadingQuestion::create([
                                'topic_id' => $topic['id'],
                                'question_number' => $questionNumber + 1,
                                'answer_key' => $answerData,
                            ]);
                        }
                    }

                    // Delete removed answers
                    $answersToDelete = array_diff($existingAnswerIds, $submittedAnswerIds);
                    foreach ($answersToDelete as $answerId) {
                        ReadingQuestion::delete(['id' => $answerId]);
                    }
                    return redirect('/exercises');
                    break;
            }
        }
        $exercise = $this->exercise::find(['id' => $id]);
        switch ($exercise['skill_type']) {
            case 'Writing':
                $topic = WritingTopic::find(['exercise_id' => $id]);
                if (!$topic) {
                    return redirect('/exercises');
                }
                return view('teacher.edit-exercise--writing', compact('id', 'exercise', 'topic'));
            case 'Listening':
                $topic = ListeningTopic::find(['exercise_id' => $id]);
                if (!$topic) {
                    return redirect('/exercises');
                }
                $answers = ListeningQuestion::query()->where('topic_id', '=', $topic['id'])->get();
                return view('teacher.edit-exercise--listening', compact('id', 'exercise', 'topic', 'answers'));
            case 'Reading':
                $topic = ReadingTopic::find(['exercise_id' => $id]);
                if (!$topic) {
                    return redirect('/exercises');
                }
                $answers = ReadingQuestion::query()->where('topic_id', '=', $topic['id'])->get();
                return view('teacher.edit-exercise--reading', compact('id', 'exercise', 'topic', 'answers'));
        }
        return;
    }

    public function deleteExercise($id)
    {
        $this->exercise::delete(['id' => $id]);
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
        $exercises = Exercise::query()
            ->select(['exercise.*'])
            ->join('curriculum', 'curriculum.exercise_id = exercise.id', 'INNER')
            ->join('course', 'curriculum.course_id = course.id', 'INNER')
            ->join('class', 'class.id_course = course.id', 'INNER')
            ->orWhere('class.id', '=', $id)
            // ->orWhere('exercise.type', '=', 'Homework')
            ->get();
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
