@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classroom List | DungES')

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
                    <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/List
                    </h4>
                    <div class="line-bottom"></div>
                </div>
                <div class="number-of">NoS: {{ count($students) }}</div>
            </div>
            <div class="table-responsive table-limit-height my-3">
                <table class="table table-custom table-big table-sticky">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>No.</th>
                            <th>ID Student</th>
                            <th>Full name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $student['id'] }}</td>
                                <td>{{ $student['name'] }}</td>
                                <td>{{ $student['gender'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($student['birth_date'])) }}</td>
                                <td>{{ $student['phone'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('classrooms/pre01/attendance') }}" class="btn-classroom px-3 w-auto">Attendance</a>
            </div>
        </div>
    </div>
@endsection
