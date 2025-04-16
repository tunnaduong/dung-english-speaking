@extends('layouts.teacher', ['active' => 4])

@section('title', 'Create Exercise | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div>
            <h4 class="fw-bold"><a href="{{ route('exercises') }}" class="back-link">
                    Exercises</a>/Create</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="border-line rounded-4 p-3 mt-3 d-flex align-items-center gap-3">
            <img src="{{ asset('menu_book_large.svg') }}">
            <div>
                <div class="position-relative">
                    <input class="fw-bold fs-5 mb-1 form-control px-2 py-0 w-200" placeholder="Enter name..."></input>
                    <img src="{{ asset('edit2.svg') }}" class="position-absolute edit-icon">
                </div>
                <div class="fw-semi text-gray">
                    <label for="level" style="width: 50px">Level</label>
                    <select name="level" id="level" class="rounded-1">
                        <option value="3-4">3.0-4.0</option>
                    </select>
                </div>
                <div class="fw-semi text-gray">
                    <label for="skill" style="width: 50px">Skill</label>
                    <select name="skill" id="skill" class="rounded-1" onchange="changePageUrl(this)">
                        <option value="reading">Reading</option>
                        <option value="writing">Writing</option>
                        <option value="listening">Listening</option>
                    </select>
                </div>
            </div>
        </div>
        <form action="" method="POST" id="addExerciseForm">
            <div>
                <label for="deBai" class="form-label fw-bold mt-3">Add topic</label>
                <textarea name="deBai" id="deBai" class="form-control" rows="10"></textarea>
            </div>
            <div>
                <label for="cauHoi" class="form-label fw-bold mt-3">Add question</label>
                <textarea name="cauHoi" id="cauHoi" class="form-control" rows="10"></textarea>
            </div>
            <div>
                <label for="cauHoi" class="form-label fw-bold mt-3">Add answers</label>
                <div class="border-line rounded-4 px-3 py-2">
                    <div>1.</div>
                    <div>2.</div>
                    <a href="#" class="text-decoration-none text-black" style="margin-left: -5px">
                        <img src="{{ asset('plus.svg') }}" class="add-icon"> Add another answer
                    </a>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-end mt-3 gap-4">
            <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
            <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#saveConfirmModal">Create</button>
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
                    <h5 class="fw-semi mb-4">Do you want to create?</h5>
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
