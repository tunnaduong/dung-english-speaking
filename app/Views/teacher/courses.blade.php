@extends('layouts.teacher', ['active' => 2])

@section('title', 'Courses | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <h4 class="fw-bold m-0 flex-shrink-0">ALL COURSES</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div class="classroom-container gap-4 mt-4">
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Pre IELTS - 27 lectures</h5>
                    <a href="{{ route('courses/pre01/edit') }}">
                        <img src="{{ asset('edit.svg') }}">
                    </a>
                </div>
                <div>Classes: 2</div>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Beginner 4.0 - 27 lectures</h5>
                    <a href="{{ route('courses/pre01/edit') }}">
                        <img src="{{ asset('edit.svg') }}">
                    </a>
                </div>
                <div>Classes: 3</div>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Upper 5.0 - 27 lectures</h5>
                    <a href="{{ route('courses/pre01/edit') }}">
                        <img src="{{ asset('edit.svg') }}">
                    </a>
                </div>
                <div>Classes: 3</div>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Super 6.0 - 27 lectures</h5>
                    <a href="{{ route('courses/pre01/edit') }}">
                        <img src="{{ asset('edit.svg') }}">
                    </a>
                </div>
                <div>Classes: 2</div>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Hero 7.5 - 27 lectures</h5>
                    <a href="{{ route('courses/pre01/edit') }}">
                        <img src="{{ asset('edit.svg') }}">
                    </a>
                </div>
                <div>Classes: 1</div>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
        </div>
    </div>
@endsection
