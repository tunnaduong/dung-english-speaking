@extends('layouts.admin', ['active' => 3])

@section('title', 'Add Course | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Add Course</h4>
        </div>
        <div>
            <h4 class="fw-bold"><a href="{{ route('courses') }}" class="back-link">Courses</a>/Edit</h4>
            <div class="line-bottom"></div>
            <form method="POST" action="" id="editCourseForm" class="my-4">
                @include('_flash')
                <table class="w-100">
                    <tr>
                        <td class="align-baseline" style="width: 200px">
                            <div class="mb-3 mt-2">Course Name</div>
                        </td>
                        <td>
                            <textarea name="course_name" class="form-control rounded-35 mb-3 bg-light" rows="2">{{ old('course_name') }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-baseline">
                            <div class="mb-3 mt-2">Number of Lessons</div>
                        </td>
                        <td>
                            <input type="text" name="NoL" class="form-control rounded-35 mb-3 bg-light"
                                value="{{ old('NoL') }}"></input>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="d-flex justify-content-end gap-4">
                <button class="btn-classroom px-4 w-auto" data-bs-toggle="modal"
                    data-bs-target="#saveConfirmModal">Save</button>
                <button class="btn-classroom px-4 w-auto" data-bs-toggle="modal"
                    data-bs-target="#cancelModal">Cancel</button>
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
                            <a class="btn btn-confirm" href="{{ route('courses') }}">Yes</a>
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
                document.getElementById("editCourseForm").submit();
            }
        </script>
    @endpush
