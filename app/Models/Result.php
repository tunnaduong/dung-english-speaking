<?php

namespace App\Models;

class Result extends Model
{
    protected static string $table = 'result';

    public static function getReadingTests($studentId)
    {
        return (new self())->select(['exercise.*', 'result.*', 'result.created_at AS date', 'exercise.id AS exercise_id'])
            ->join('exercise', 'exercise.id = result.exercise_id AND result.student_id = ' . $studentId, 'RIGHT')
            ->where('exercise.skill_type', '=', 'Reading')
            ->where('exercise.type', '=', 'Test')
            ->get();
    }

    public static function getWritingTests($studentId)
    {
        return (new self())->select(['exercise.*', 'result.*', 'result.created_at AS date', 'exercise.id AS exercise_id'])
            ->join('exercise', 'exercise.id = result.exercise_id AND result.student_id = ' . $studentId, 'RIGHT')
            ->where('exercise.skill_type', '=', 'Writing')
            ->where('exercise.type', '=', 'Test')
            ->get();
    }

    public static function getListeningTests($studentId)
    {
        return (new self())->select(['exercise.*', 'result.*', 'result.created_at AS date', 'exercise.id AS exercise_id'])
            ->join('exercise', 'exercise.id = result.exercise_id AND result.student_id = ' . $studentId, 'RIGHT')
            ->where('exercise.skill_type', '=', 'Listening')
            ->where('exercise.type', '=', 'Test')
            ->get();
    }

    public static function getReadingHomeworks($studentId)
    {
        return (new self())->select(['exercise.*', 'result.*', 'result.created_at AS date', 'exercise.id AS exercise_id'])
            ->join('exercise', 'exercise.id = result.exercise_id AND result.student_id = ' . $studentId, 'RIGHT')
            ->where('exercise.skill_type', '=', 'Reading')
            ->where('exercise.type', '=', 'Homework')
            ->get();
    }

    public static function getWritingHomeworks($studentId)
    {
        return (new self())->select(['exercise.*', 'result.*', 'result.created_at AS date', 'exercise.id AS exercise_id'])
            ->join('exercise', 'exercise.id = result.exercise_id AND result.student_id = ' . $studentId, 'RIGHT')
            ->where('exercise.skill_type', '=', 'Writing')
            ->where('exercise.type', '=', 'Homework')
            ->get();
    }

    public static function getListeningHomeworks($studentId)
    {
        return (new self())->select(['exercise.*', 'result.*', 'result.created_at AS date', 'exercise.id AS exercise_id'])
            ->join('exercise', 'exercise.id = result.exercise_id AND result.student_id = ' . $studentId, 'RIGHT')
            ->where('exercise.skill_type', '=', 'Listening')
            ->where('exercise.type', '=', 'Homework')
            ->get();
    }
}
