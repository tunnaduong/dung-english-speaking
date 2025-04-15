<?php

namespace App\Models;

class Absence extends Model
{
    protected static string $table = 'absence';
    protected static string $primaryKey = 'absence_id';

    public static function getAbsenceHistory($studentId)
    {
        return (new self())->select(['class.class_name', 'absence.reason', 'absence.date'])->join('makeup_class', 'absence.makeup_class_id = makeup_class.id', 'LEFT')->join('class', 'class.id = makeup_class.class_id', 'LEFT')->where('absence.student_id', '=', $studentId)->get();
    }
}
