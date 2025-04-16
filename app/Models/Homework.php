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

    public static function getReadingTestById($id)
    {
        return (new self())->select(['exercise.*', 'reading_topics.*', 'reading_topics.id AS topic_id'])->join('reading_topics', 'reading_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }

    public static function getWritingTestById($id)
    {
        return (new self())->select(['exercise.*', 'writing_topics.*', 'writing_topics.id AS topic_id'])->join('writing_topics', 'writing_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }

    public static function getListeningTestById($id)
    {
        return (new self())->select(['exercise.*', 'listening_topics.*', 'listening_topics.id AS topic_id'])->join('listening_topics', 'listening_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }

    public static function getWritingHomeworkById($id)
    {
        return (new self())->select(['exercise.*', 'writing_topics.*', 'writing_topics.id AS topic_id'])->join('writing_topics', 'writing_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }

    public static function getReadingHomeworkById($id)
    {
        return (new self())->select(['exercise.*', 'reading_topics.*', 'reading_topics.id AS topic_id'])->join('reading_topics', 'reading_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }

    public static function getListeningHomeworkById($id)
    {
        return (new self())->select(['exercise.*', 'listening_topics.*', 'listening_topics.id AS topic_id'])->join('listening_topics', 'listening_topics.exercise_id = exercise.id')->where('exercise.id', '=', $id)->first();
    }
}
