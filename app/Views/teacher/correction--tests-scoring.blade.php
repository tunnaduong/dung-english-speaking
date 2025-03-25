@extends('layouts.teacher', ['active' => 5])

@section('title', 'Homework Scoring | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">
                <a href="{{ route('correction') }}" class="back-link">
                    Correction</a>/Tests
            </h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg"
                    id="search" name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Pre IELTS 01 - Tests</h4>
        </div>
        <form action="" method="POST" class="m-0">
            <div>
                <h4 class="fw-bold"><a href="{{ route("correction/$id/tests") }}" class="back-link">
                        < Tests</a>/<a href="{{ route("correction/$id/tests/$homeworkId") }}" class="back-link">Writing
                                1</a>/Trịnh Duy Hoàng
                </h4>
                <div class="line-bottom"></div>
            </div>
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
    </div>
    </div>
@endsection
