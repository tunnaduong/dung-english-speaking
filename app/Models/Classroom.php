<?php

namespace App\Models;

class Classroom extends Model
{
    protected static string $table = 'class';
    protected static string $primaryKey = 'id';

    public static function getClasses($teacherId)
    {
        return (new self())->select(['class.id AS class_id', 'class.*', 'info_employee.*', 'course.*'])->where('teacher_id', '=', $teacherId)
            ->join('info_employee', 'class.teacher_id = info_employee.id', 'INNER')
            ->join('course', 'class.id_course = course.id', 'INNER')
            ->get();
    }
}
