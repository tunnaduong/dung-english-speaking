@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classroom Attendance | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Pre IELTS 01 - 27 lectures</h4>
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
                                        <select name="attendance[{{ $student['student_id'] }}][day_{{ $i }}]"
                                            class="form-select form-select-sm w-100">
                                            <option value="present"
                                                {{ ($student['days']['day_' . $i] ?? 'present') === 'present' ? 'selected' : '' }}>
                                                Có</option>
                                            <option value="absent"
                                                {{ ($student['days']['day_' . $i] ?? '') === 'absent' ? 'selected' : '' }}>
                                                Vắng</option>
                                            <option value="late"
                                                {{ ($student['days']['day_' . $i] ?? '') === 'late' ? 'selected' : '' }}>Đi
                                                muộn</option>
                                            <option value="excused"
                                                {{ ($student['days']['day_' . $i] ?? '') === 'excused' ? 'selected' : '' }}>
                                                Có phép</option>
                                        </select>
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('classrooms/' . $id . '/attendance/submit') }}"
                    class="btn-classroom px-3 w-auto">Submit</a>
            </div>
        </div>
    </div>
@endsection
