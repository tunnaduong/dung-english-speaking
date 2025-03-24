<?php

namespace App\Models;

class Student extends Model
{
    protected static string $table = 'students';
    protected static string $primaryKey = 'id';

    public static function findByEmail($email)
    {
        return (new self())->where('email', '=', $email)
            ->join('info_student', 'students.student_id = info_student.id', 'INNER')
            ->first();
    }
}
