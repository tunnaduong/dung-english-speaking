@extends('layouts.teacher', ['active' => 4])

@section('title', 'Edit Exercise | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div>
            <h4 class="fw-bold"><a href="{{ route('exercises') }}" class="back-link">
                    Exercises</a>/Edit</h4>
            <div class="line-bottom"></div>
        </div>
        <form action="" method="POST" id="addExerciseForm">
            <div class="border-line rounded-4 p-3 mt-3 d-flex align-items-center gap-3">
                <img src="{{ asset('menu_book_large.svg') }}">
                <div>
                    <div class="position-relative">
                        <input class="fw-bold fs-5 mb-1 form-control px-2 py-0 w-200" placeholder="Enter name..."
                            name="name" value="{{ $exercise['name'] }}"></input>
                        <img src="{{ asset('edit2.svg') }}" class="position-absolute edit-icon">
                    </div>
                    <div class="fw-semi text-gray">
                        <label for="level" style="width: 50px">Level</label>
                        <select name="level" id="level" class="rounded-1">
                            <option value="3.0-4.0">3.0-4.0</option>
                        </select>
                    </div>
                    <div class="fw-semi text-gray">
                        <label for="skill" style="width: 50px">Skill</label>
                        <select name="skill" id="skill" class="rounded-1" onchange="changePageUrl(this)">
                            <option value="reading">Reading</option>
                        </select>
                    </div>
                    <div class="fw-semi text-gray">
                        <label for="type" style="width: 50px">Type</label>
                        <select name="type" id="type" class="rounded-1">
                            <option value="Homework" {{ $exercise['type'] == 'Homework' ? 'selected' : '' }}>Homework
                            </option>
                            <option value="Test" {{ $exercise['type'] == 'Test' ? 'selected' : '' }}>Test</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <label for="title" class="form-label fw-bold mt-3">Add title</label>
                <input name="title" id="title" class="form-control w-50" placeholder="Enter title..."
                    value="{{ $topic['title'] }}"></input>
            </div>
            <div>
                <label for="deBai" class="form-label fw-bold mt-3">Add topic</label>
                <textarea name="topic" id="deBai" class="form-control" rows="10">{{ $topic['content'] }}</textarea>
            </div>
            <div>
                <label for="cauHoi" class="form-label fw-bold mt-3">Add question</label>
                <textarea name="question" id="cauHoi" class="form-control" rows="10">{{ $topic['question'] }}</textarea>
            </div>
            <div>
                <label for="answersContainer" class="form-label fw-bold mt-3">Add answers</label>
                <div class="border-line rounded-4 px-3 py-2" id="answersContainer">
                    @foreach ($answers as $answer)
                        <div>{{ $answer['question_number'] }}. <input type="text" class="no-border-input"
                                name="answers[]" value="{{ $answer['answer_key'] }}"></div>
                    @endforeach
                    <a href="javascript:void(0)" class="text-decoration-none text-black" style="margin-left: -5px"
                        onclick="addAnotherAnswer()">
                        <img src="{{ asset('plus.svg') }}" class="add-icon"> Add another answer
                    </a>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-end mt-3 gap-4">
            <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
            <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#saveConfirmModal">Save</button>
        </div>
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
                        <a class="btn btn-confirm" href="{{ route('exercises') }}">Yes</a>
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
        function changePageUrl(selectElement) {
            const selectedValue = selectElement.value; // Get the selected option value
            const currentUrl = window.location.origin + window.location
                .pathname; // Get the current URL without query params
            const newUrl = `${currentUrl}?type=${selectedValue}`; // Append the selected value as a query parameter
            window.location.href = newUrl; // Redirect to the new URL
        }

        function submitForm() {
            document.getElementById("addExerciseForm").submit();
        }

        function addAnotherAnswer() {
            const container = document.getElementById('answersContainer');
            const currentCount = container.querySelectorAll('input[name="answers[]"]')
                .length; // Count existing answer fields
            const newAnswer = document.createElement('div'); // Create a new div for the answer
            newAnswer.innerHTML =
                `${currentCount + 1}. <input type="text" class="no-border-input" name="answers[]">`; // Increment the number and set the name
            container.insertBefore(newAnswer, container.lastElementChild); // Insert before the "Add another answer" link
        }
        CKEDITOR.replace('deBai');
        CKEDITOR.replace('cauHoi');
    </script>
@endpush

@push('styles')
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
@endpush
