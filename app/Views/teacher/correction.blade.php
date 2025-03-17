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
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <h5 class="fw-bold">PRE01</h5>
                <div class="fw-semi">Pre IELTS 01 - 27 lectures</div>
                <div>Teacher: Hoàng Tiến Dũng</div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('correction/1/homeworks') }}" class="btn-classroom">Homeworks</a>
                    <a href="{{ route('correction/1/tests') }}" class="btn-classroom">Tests</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <h5 class="fw-bold">BEGINNER01</h5>
                <div class="fw-semi">Beginner 4.0 - 27 lectures</div>
                <div>Teacher: Hoàng Tiến Dũng</div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('correction/2/homeworks') }}" class="btn-classroom">Homeworks</a>
                    <a href="{{ route('correction/2/tests') }}" class="btn-classroom">Tests</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <h5 class="fw-bold">UPPER03</h5>
                <div class="fw-semi">Upper 5.0 - 27 lectures</div>
                <div>Teacher: Hoàng Tiến Dũng</div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('correction/3/homeworks') }}" class="btn-classroom">Homeworks</a>
                    <a href="{{ route('correction/3/tests') }}" class="btn-classroom">Tests</a>
                </div>
            </div>
        </div>
    </div>
@endsection
