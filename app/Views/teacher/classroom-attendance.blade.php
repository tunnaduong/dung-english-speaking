@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classroom Attendance | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">{{ $course['course_name'] }} - {{ $course['NoL'] }} lectures</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/<a
                            href="{{ route('classrooms/' . $id . '/list') }}" class="back-link">List</a>/Attendance
                    </h4>
                    <div class="line-bottom"></div>
                </div>
                <div class="number-of">NoS: {{ count($studentData) }}</div>
            </div>
            <form action="{{ route('classrooms/' . $id . '/attendance/submit') }}" method="POST" id="attendanceForm">
                <div class="table-responsive table-limit-height my-3">
                    <table class="table table-custom table-big table-sticky table-horizontal" style="white-space: nowrap">
                        <thead class="overflow-hidden">
                            <tr>
                                <th>No.</th>
                                <th>ID Student</th>
                                <th>Full name</th>
                                @for ($i = 1; $i <= $course['NoL']; $i++)
                                    <th style="min-width: 135px">Day {{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentData as $student)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $student['student_id'] }}</td>
                                    <td>{{ $student['name'] }}</td>
                                    @for ($i = 1; $i <= $course['NoL']; $i++)
                                        <td>
                                            <select
                                                name="attendance[{{ $student['student_id'] }}][day_{{ $i }}]"
                                                class="form-select form-select-sm w-100">
                                                <option value="present"
                                                    {{ ($student['days'][$i - 1] ?? '') === 'Có' ? 'selected' : '' }}>
                                                    Có</option>
                                                <option value="absent"
                                                    {{ ($student['days'][$i - 1] ?? '') === 'Vắng' ? 'selected' : '' }}>
                                                    Vắng</option>
                                                <option value="late"
                                                    {{ ($student['days'][$i - 1] ?? '') === 'Đi muộn' ? 'selected' : '' }}>
                                                    Đi
                                                    muộn</option>
                                                <option value="excused"
                                                    {{ ($student['days'][$i - 1] ?? '') === 'Có phép' ? 'selected' : '' }}>
                                                    Có phép</option>
                                            </select>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="d-flex justify-content-end">
                <button class="btn-classroom px-3 w-auto" data-bs-toggle="modal"
                    data-bs-target="#saveConfirmModal">Submit</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <div class="modal fade" id="saveConfirmModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to submit?</h5>
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
            document.getElementById("attendanceForm").submit();
        }
    </script>
@endpush
