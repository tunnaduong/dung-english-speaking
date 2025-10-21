<?php

namespace App\Models;

use App\Core\DB;

class Course extends Model
{
  protected static string $table = 'course';
  protected static string $primaryKey = 'id';

  public static function getCourseContent($id)
  {
    $sql = "SELECT curriculum.*, curriculum.id AS c_id, curriculum.created_at AS c_created_at, course.* FROM curriculum INNER JOIN course ON course.id = curriculum.course_id WHERE course_id = ?";
    return DB::query($sql, [$id])->fetchAll();
  }

  public static function getCourseByClassId($classId)
  {
    return (new self())->join('class', 'class.id_course = course.id')->where('class.id', '=', $classId)->first();
  }

  public static function getAllCourses()
  {
    return (new self())->get();
  }

  public static function getCoursesByStudentId($studentId)
  {
    $sql = "SELECT class.*, info_student.*, course.*, class.id AS c_id FROM info_student INNER JOIN class ON class.id = info_student.class_id INNER JOIN course ON class.id_course = course.id WHERE info_student.id = ?";
    return DB::query($sql, [$studentId])->fetchAll();
  }

  public static function getCoursesByTeacherId($teacherId)
  {
    $sql = "SELECT course.id AS co_id, course.course_name, course.NoL, COUNT(class.id) AS total_classes FROM info_employee INNER JOIN class ON class.teacher_id = info_employee.id INNER JOIN course ON class.id_course = course.id WHERE info_employee.id = ? GROUP BY course.id, course.course_name, course.NoL";
    return DB::query($sql, [$teacherId])->fetchAll();
  }

  public static function getAllCoursesInAdmin()
  {
    $sql = "SELECT course.id, course.course_name, course.NoL, COUNT(class.id) AS total_classes FROM course LEFT JOIN class ON course.id = class.id_course GROUP BY course.id, course.course_name, course.NoL";
    return DB::query($sql)->fetchAll();
  }

  public static function searchCoursesByName(string $name)
  {
    return (new self())->where('course_name', 'LIKE', "%$name%")->get();
  }
}
