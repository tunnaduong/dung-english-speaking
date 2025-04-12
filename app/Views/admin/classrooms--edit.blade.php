@extends('layouts.admin', ['active' => 0])

@section('title', 'Edit Classroom | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Edit Classroom</h4>
        </div>
        <div>
            <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/Edit
            </h4>
            <div class="line-bottom"></div>
        </div>
        <form method="POST" action="" id="editCourseForm" class="my-4">
            @include('_flash')
            <table class="w-100">
                <tr>
                    <td style="width: 250px">
                        <div class="mb-3">Class ID</d>
                    </td>
                    <td>
                        <div class="session-id mb-3">{{ $id }}</div>
                    </td>
                </tr>
                <tr>
                    <td class="align-baseline">
                        <div class="mb-3 mt-2">Class Name</div>
                    </td>
                    <td>
                        <textarea name="class_name" class="form-control rounded-35 mb-3 bg-light" rows="2">{{ $classroom['class_name'] }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3 mt-2">Number of Students</div>
                    </td>
                    <td>
                        <input type="number" min="1" max="99" class="form-control mb-3 rounded-35 bg-light"
                            value="{{ $classroom['NoS'] }}" name="NoS">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3 mt-2">Start Date</div>
                    </td>
                    <td>
                        <input type="date" class="form-control mb-3 rounded-35 bg-light"
                            value="{{ $classroom['start_date'] }}" name="start_date">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3 mt-2">End Date</div>
                    </td>
                    <td>
                        <input type="date" class="form-control mb-3 rounded-35 bg-light"
                            value="{{ $classroom['end_date'] }}" name="end_date">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3 mt-2">Course Name</div>
                    </td>
                    <td>
                        <select name="id_course" class="form-select mb-3 rounded-35 bg-light">
                            <option disabled {{ $classroom['id_course'] == null ? 'selected' : '' }}>Choose one</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course['id'] }}"
                                    {{ $course['id'] == $classroom['id_course'] ? 'selected' : '' }}>
                                    {{ $course['course_name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3 mt-2">Assign Teacher</div>
                    </td>
                    <td>
                        <select name="teacher_id" id="teacher" class="form-select w-100 rounded-35 bg-light mb-3">
                            <option disabled {{ $classroom['teacher_id'] == null ? 'selected' : '' }}>Choose one</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher['id'] }}"
                                    {{ $classroom['teacher_id'] == $teacher['id'] ? 'selected' : '' }}>
                                    {{ $teacher['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3 mt-2">Assign Teaching Assistant</div>
                    </td>
                    <td>
                        <select name="assistant_id" id="ta" class="form-select w-100 rounded-35 bg-light mb-3">
                            <option disabled {{ $classroom['assistant_id'] == null ? 'selected' : '' }}>Choose one</option>
                            @foreach ($tas as $ta)
                                <option value="{{ $ta['id'] }}"
                                    {{ $classroom['assistant_id'] == $ta['id'] ? 'selected' : '' }}>
                                    {{ $ta['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="update_by" value="{{ session('user')['user_id'] }}">
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
                        <a class="btn btn-confirm" href="{{ route('classrooms') }}">Yes</a>
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
