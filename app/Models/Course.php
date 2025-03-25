<?php

namespace App\Models;

use App\Core\DB;

class Course extends Model
{
    protected static string $table = 'course';
    protected static string $primaryKey = 'id';

    public static function getCourseContent($id)
    {
        $sql = "SELECT curriculum.*, curriculum.id AS c_id FROM curriculum INNER JOIN course ON course.id = curriculum.course_id WHERE course_id = ?";
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
}
