@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classroom List | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <h4 class="fw-bold m-0 flex-shrink-0">Pre IELTS 01 - 27 lectures</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div>
            <h4 class="fw-bold"><a href="{{ route('absence') }}" class="back-link">Absence</a>/Leave of
                absence
            </h4>
            <div class="line-bottom"></div>
        </div>
    </div>
@endsection
