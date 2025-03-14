@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classroom Curriculum | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Beginner 4.0 - 27 lectures</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/Curriculum
                    </h4>
                    <div class="line-bottom"></div>
                </div>
                <a href="{{ route('classrooms/pre01/curriculum/add') }}" class="btn-classroom px-3 w-auto"><img
                        src="{{ asset('add.svg') }}" class="me-2" />Add new</a>
            </div>
            <div class="table-responsive my-3">
                <table class="table table-custom table-big table-sticky table-horizontal">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>No.</th>
                            <th>Session</th>
                            <th>Topic</th>
                            <th style="min-width: 135px;">Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($curriculums as $curriculum)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $curriculum['session'] }}</td>
                                <td>{{ $curriculum['topic'] }}</td>
                                <td>{{ $curriculum['date'] }}</td>
                                <td><a href="{{ route('classrooms/pre01/curriculum/' . $curriculum['session'] . '/edit') }}"
                                        class="me-2">
                                        <img src="{{ asset('edit.svg') }}" /></a><a
                                        href="{{ route('classrooms/pre01/curriculum/' . $curriculum['session'] . '/delete') }}"
                                        onclick="return confirm('Are you sure you want to delete this curriculum?')"><img
                                            src="{{ asset('delete.svg') }}" /></a>
                                </td>
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
