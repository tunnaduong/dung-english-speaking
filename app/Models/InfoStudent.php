<?php

namespace App\Models;

class InfoStudent extends Model
{
    protected static string $table = 'info_student';
    protected static string $primaryKey = 'id';

    public static function getStudents($id)
    {
        return (new self())->where('class_id', '=', $id)->get();
    }
}
