<?php

namespace App\Models;

use App\Core\DB;

class Course extends Model
{
    protected static string $table = 'course';
    protected static string $primaryKey = 'id';

    public static function getCourseContent($id)
    {
        $sql = "SELECT * FROM curriculum INNER JOIN course ON course.id = curriculum.course_id WHERE course_id = ?";
        return DB::query($sql, [$id])->fetchAll();
    }
}
