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
        return (new self())->where('id', '=', $classId)->first();
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
        $sql = "SELECT class.*, info_employee.*, course.*, course.id AS co_id, class.id AS c_id FROM info_employee LEFT JOIN class ON class.teacher_id = info_employee.id LEFT JOIN course ON class.id_course = course.id WHERE info_employee.id = ?";
        return DB::query($sql, [$teacherId])->fetchAll();
    }
}
