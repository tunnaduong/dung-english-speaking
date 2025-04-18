<?php

namespace App\Models;

use App\Core\DB;

class Classroom extends Model
{
    protected static string $table = 'class';
    protected static string $primaryKey = 'id';

    public static function getMakeupClasses()
    {
        $sql = "SELECT c.id AS class_id, c.class_name, s.day_of_week1, s.day_of_week2, s.shift1, s.shift2, cp.date FROM class c JOIN course co ON co.id = c.id_course JOIN curriculum cu ON cu.course_id = co.id JOIN class_progress cp ON cp.curriculum_id = cu.id JOIN schedules sc ON sc.id = cu.exercise_id LEFT JOIN schedules s ON s.id = sc.id";
        return DB::query($sql)->fetchAll();
    }

    public static function getClasses($teacherId)
    {
        return (new self())->select(['class.id AS class_id', 'class.*', 'info_employee.*', 'course.*'])->where('teacher_id', '=', $teacherId)
            ->join('info_employee', 'class.teacher_id = info_employee.id', 'INNER')
            ->join('course', 'class.id_course = course.id', 'INNER')
            ->get();
    }
}
