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
            @foreach ($courses as $course)
                <div class="border-line p-4 rounded-4 m-2 classroom">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">{{ $course['course_name'] }} - {{ $course['NoL'] }} lectures</h5>
                        <a href="{{ route('courses/' . $course['co_id'] . '/edit') }}">
                            <img src="{{ asset('edit.svg') }}">
                        </a>
                    </div>
                    <div>Classes: {{ $course['total_classes'] }}</div>
                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <a href="{{ route('classrooms/' . $course['co_id'] . '/curriculum') }}"
                            class="btn-classroom">Curriculum</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
