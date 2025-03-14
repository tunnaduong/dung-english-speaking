@extends('layouts.teacher', ['active' => 1])

@section('title', 'Edit Curriculum | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Beginner 4.0 - 27 lectures</h4>
        </div>
        <div>
            <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/<a
                    href="{{ route('classrooms/pre01/curriculum') }}" class="back-link">Curriculum</a>/Edit
            </h4>
            <div class="line-bottom"></div>
        </div>
        <form method="POST" action="" id="editCurriculumForm" class="my-4">
            <table class="w-100">
                <tr>
                    <td style="width: 150px">
                        <div class="mb-3">Session ID</d>
                    </td>
                    <td>
                        <div class="session-id mb-3">{{ $curriculumId }}</div>
                        <input type="hidden" name="session_id" value="BG01028">
                    </td>
                </tr>
                <tr>
                    <td class="align-baseline">
                        <div class="mb-3 mt-2">Topic</div>
                    </td>
                    <td>
                        <textarea name="topic" placeholder="Add topic..." class="form-control rounded-35 mb-3 bg-light" rows="3">Testing: Final test</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3">Date</div>
                    </td>
                    <td>
                        <input type="date" name="date" class="form-control w-200 mb-3 rounded-35 bg-light"
                            value="2025-03-02">
                    </td>
                </tr>
                <tr>
                    <td>Exercise</td>
                    <td>
                        <select name="exercise" class="form-select w-200 rounded-35 bg-light">
                            <option value="listen1">Listening 1</option>
                            <option value="listen2">Listening 2</option>
                            <option value="listen3">Listening 3</option>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        <div class="d-flex justify-content-end gap-4">
            <button class="btn-classroom px-4 w-auto" data-bs-toggle="modal"
                data-bs-target="#saveConfirmModal">Save</button>
            <button class="btn-classroom px-4 w-auto" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
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
                        <a class="btn btn-confirm" href="{{ route('classrooms/pre01/curriculum') }}">Yes</a>
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
            document.getElementById("editCurriculumForm").submit();
        }
    </script>
@endpush

{{-- Done Edit Curriculum --}}
