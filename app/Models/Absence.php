<?php

namespace App\Models;

class Absence extends Model
{
    protected static string $table = 'absence';
    protected static string $primaryKey = 'absence_id';

    public static function getAbsenceHistory($studentId)
    {
        return (new self())->where('student_id', '=', $studentId)->get();
    }
}
