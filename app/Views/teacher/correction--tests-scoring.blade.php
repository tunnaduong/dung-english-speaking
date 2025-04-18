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
            <h4 class="fw-bold m-0 flex-shrink-0">{{ $classroom['class_name'] }} - Tests</h4>
        </div>
        <form action="" method="POST" class="m-0" id="homeworkForm">
            <div>
                <h4 class="fw-bold"><a href="{{ route("correction/$id/tests") }}" class="back-link">
                        < Tests</a>/<a href="{{ route("correction/$id/tests/$homeworkId") }}"
                                class="back-link">{{ $exercise['name'] }}</a>/{{ $answer['name'] }}</h4>
                </h4>
                <div class="line-bottom"></div>
            </div>
            <div class="border-line p-2 rounded-4 mt-4 limit-height">
                <div class="fw-bold">Topic:</div>
                <div>{!! $answer['topic'] !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                <div>{!! nl2br($answer['content']) !!}</div>
            </div>
            <input type="hidden" name="answer_id" value="{{ $answer['answer_id'] }}">
            <div class="border-line p-2 rounded-4 mt-3">
                <div>Comments:</div>
                <textarea name="feedback" id="comment" rows="5" class="form-control border-0 shadow-none ps-0">{{ $answer['feedback'] }}</textarea>
            </div>
            <div class="d-flex justify-content-end mt-3 gap-4">
                <div class="position-relative">
                    <div class="position-absolute score-text">Scores:</div>
                    <input type="text" class="form-control w-200 score" id="score" name="score"
                        value="{{ $answer['score'] }}">
                </div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#cancelModal"
                    class="btn-classroom">Cancel</button>
                <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#saveConfirmModal"
                    type="button">Save</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="cancelModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to cancel?</h5>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-confirm" href="{{ route("correction/$id/tests/$homeworkId") }}">Yes</a>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="saveConfirmModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to save?</h5>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-confirm" onclick="submitForm()">Yes</button>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById("homeworkForm").submit();
        }
    </script>
@endpush
