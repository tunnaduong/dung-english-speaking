@extends('layouts.teacher', ['active' => 5])

@section('title', 'Homeworks | DungES')

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
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="fw-bold"><a href="{{ route("correction/$id/tests") }}" class="back-link">
                            < Tests</a>/Writing 1
                    </h4>
                    <div class="line-bottom"></div>
                </div>
                <div class="number-of">NoS: {{ count($students) }}</div>
            </div>
            <div class="table-responsive my-3">
                <table class="table table-custom table-big table-sticky m-0">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>No.</th>
                            <th>ID Student</th>
                            <th>Full name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Score</th>
                            <th></th>
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
                                <td>{!! $student['score'] == 'N/A'
                                    ? "<a href='" . route("correction/$id/tests/$homeworkId/" . $student['id']) . "'>N/A</a>"
                                    : $student['score'] !!}</td>
                                <td><a href="{{ route("correction/$id/tests/$homeworkId/" . $student['id']) }}"
                                        class="me-2">
                                        <img src="{{ asset('edit.svg') }}" width="25" /></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link w-40" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link w-40" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link w-40" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
