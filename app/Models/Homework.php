<?php

namespace App\Models;

class Homework extends Model
{
    protected static string $table = 'exercise';
    protected static string $primaryKey = 'id';

    public static function getHomeworks()
    {
        return (new self())->where('type', '=', 'Homework')->get();
    }

    public static function getTests()
    {
        return (new self())->where('type', '=', 'Test')->get();
    }

    public static function getWritingHomeworkById($id)
    {
        return (new self())->join('writing_topics', 'writing_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }
}
