@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classrooms | DungES')

@section('content')
    <div class="w-100 mt-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <h4 class="fw-bold m-0 flex-shrink-0">MY CLASSES</h4>
            <div class="position-relative">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="email" placeholder="Searching"
                    class="search-input form-control form-control-lg {{ $errors['email'] ?? null ? 'is-invalid' : '' }}"
                    id="email" name="email" value="{{ $_POST['email'] }}">
            </div>
        </div>
    </div>
@endsection
