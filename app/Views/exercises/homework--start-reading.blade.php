@extends('layouts.home', ['active' => 2])

@section('title', 'Start Homework | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ route('exercises/homeworks') }}">
                &lt; Reading</a>/Homework 1
        </div>
        <form action="" method="POST" class="m-0">
            <div class="border-line p-2 rounded-4 mt-4">
                <div class="fw-bold">Topic:</div>
                <div>Many people prefer to live in big cities, while others enjoy living in the countryside.<br>
                    Write about the advantages and disadvantages of both lifestyles. Give your own opinion. (150-200 words)
                </div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3">
                <div>Many people choose to live in big cities because they offer many opportunities. In cities, there are
                    good jobs, modern facilities, and many entertainment options. People can find better schools and
                    hospitals, which help improve their quality of life. However, city life can be stressful. It is often
                    noisy, crowded, and expensive. Traffic jams and pollution are also big problems.
                    On the other hand, living in the countryside is more peaceful. The environment </div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3">
                <div>Comments:</div>
                <textarea name="comment" id="comment" rows="5" class="form-control border-0 shadow-none ps-0"></textarea>
            </div>
            <div class="d-flex justify-content-end mt-3 gap-4">
                <div class="position-relative">
                    <div class="position-absolute score-text">Scores:</div>
                    <input type="text" class="form-control w-200 score" id="score" name="score">
                </div>
                <a href="{{ route("correction/$id/tests/$homeworkId") }}" class="btn-classroom">Cancel</a>
                <button class="btn-classroom" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
