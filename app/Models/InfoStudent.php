<?php

namespace App\Models;

use App\Core\DB;

class InfoStudent extends Model
{
    protected static string $table = 'info_student';
    protected static string $primaryKey = 'id';

    public static function getStudents($id)
    {
        return (new self())->where('class_id', '=', $id)->get();
    }

    public static function getAllStudents()
    {
        return (new self())->select(['info_student.id AS s_id', 'students.*', 'info_student.*', 'class.*'])
            ->join('class', 'info_student.class_id = class.id', 'INNER')
            ->join('students', 'info_student.id = students.student_id', 'LEFT')
            ->get();
    }

    public static function searchStudentsByName(string $name)
    {
        return (new self())->select(['info_student.id AS s_id', 'students.*', 'info_student.*', 'class.*'])
            ->join('class', 'info_student.class_id = class.id', 'INNER')
            ->join('students', 'info_student.id = students.student_id', 'LEFT')
            ->where('name', 'LIKE', "%$name%") // Searching with LIKE for partial matches
            ->get();
    }

    public static function getStudentById($id)
    {
        $sql = "SELECT info_student.id AS s_id, students.*, info_student.*
                FROM info_student
                LEFT JOIN students ON info_student.id = students.student_id
                WHERE info_student.id = ?";
        return DB::query($sql, [$id])->fetch();
    }
}
