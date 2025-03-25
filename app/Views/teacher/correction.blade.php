@extends('layouts.teacher', ['active' => 5])

@section('title', 'Correction | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <h4 class="fw-bold m-0 flex-shrink-0">MY CLASSES</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div class="classroom-container gap-4 mt-4">
            @foreach ($classrooms as $classroom)
                <div class="border-line p-4 rounded-4 m-2 classroom">
                    <h5 class="fw-bold">{{ $classroom['class_name'] }}</h5>
                    <div class="fw-semi">{{ $classroom['NoL'] }} lectures</div>
                    <div>Teacher: {{ $classroom['name'] }}</div>
                    <div class="d-flex gap-2 justify-content-between mt-3">
                        <a href="{{ route('correction/' . $classroom['class_id'] . '/homeworks') }}"
                            class="btn-classroom">Homeworks</a>
                        <a href="{{ route('correction/' . $classroom['class_id'] . '/tests') }}"
                            class="btn-classroom">Tests</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
