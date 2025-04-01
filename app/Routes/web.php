<?php

/** @var Phroute\Phroute\RouteCollector $route */

use App\Core\Asset\Asset;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\AbsenceController;
use App\Controllers\TeacherController;

// Student
$route->get('/', [HomeController::class, 'index']);
$route->get('/profile', [HomeController::class, 'profile']);
$route->post('/profile/update', [HomeController::class, 'updateProfile']);
$route->get('/courses', [HomeController::class, 'courses']);
$route->get('/courses/{id}', [HomeController::class, 'courseDetail']);
$route->get('/exercises', [HomeController::class, 'exercise']);
$route->get('/exercises/homeworks', [HomeController::class, 'homework']);
$route->get('/exercises/tests', [HomeController::class, 'test']);
$route->get('/absence', [HomeController::class, 'absence']);
$route->get('/absence/leave', [AbsenceController::class, 'leave']);
$route->get('/absence/history', [AbsenceController::class, 'history']);
$route->post('/absence/leave/store', [AbsenceController::class, 'store']);
$route->get('/absence/leave/make-up', [AbsenceController::class, 'makeUp']);
// Teacher
$route->get('/classrooms', [TeacherController::class, 'classroom']);
$route->get('/classrooms/{id}/list', [TeacherController::class, 'classroomList']);
$route->get('/classrooms/{id}/curriculum', [TeacherController::class, 'classroomCurriculum']);
$route->any('/classrooms/{id}/curriculum/add', [TeacherController::class, 'addCurriculum']);
$route->any('/classrooms/{id}/curriculum/{curriculumId}/edit', [TeacherController::class, 'editCurriculum']);
$route->get('/classrooms/{id}/curriculum/{curriculumId}/delete', [TeacherController::class, 'deleteCurriculum']);
$route->get('/classrooms/{id}/attendance', [TeacherController::class, 'classroomAttendance']);
$route->any('/courses/{id}/edit', [TeacherController::class, 'editCourse']);
$route->get('/students', [TeacherController::class, 'students']);
$route->get('/students/{id}/profile', [TeacherController::class, 'studentProfile']);
$route->get('/students/{id}/class/{classId}', [TeacherController::class, 'studentProfileClassDetail']);
$route->get('/correction', [TeacherController::class, 'correction']);
$route->get('/correction/{id}/homeworks', [TeacherController::class, 'correctionHomework']);
$route->get('/correction/{id}/homeworks/{homeworkId}', [TeacherController::class, 'correctionHomeworkView']);
$route->any('/correction/{id}/homeworks/{homeworkId}/{studentId}', [TeacherController::class, 'correctionHomeworkScoring']);
$route->get('/correction/{id}/tests', [TeacherController::class, 'correctionTest']);
$route->get('/correction/{id}/tests/{homeworkId}', [TeacherController::class, 'correctionTestView']);
$route->any('/correction/{id}/tests/{homeworkId}/{studentId}', [TeacherController::class, 'correctionTestScoring']);
$route->any('/exercises/create', [TeacherController::class, 'createExercise']);
$route->get('/exercises/{id}/delete', [TeacherController::class, 'deleteExercise']);
$route->any('/exercises/{id}/edit', [TeacherController::class, 'editExercise']);
// Admin
$route->get('/employees', [AdminController::class, 'employees']);
$route->any('/employees/add', [AdminController::class, 'addEmployee']);
$route->any('/employees/{id}/edit', [AdminController::class, 'editEmployee']);
$route->get('/employees/{id}/delete', [AdminController::class, 'deleteEmployee']);
// Auth
$route->any('/login', [AuthController::class, 'login']);
$route->any('/forgot-password', [AuthController::class, 'forgotPassword']);
$route->any('/password/reset/{token}', [AuthController::class, 'resetPassword']);
$route->get('/logout', [AuthController::class, 'logout']);

// Route for serving images ( DON'T REMOVE THIS LINE )
$route->get('/assets/uploads/{fileName}', function ($fileName) {
  Asset::downloadImage($fileName);
});
