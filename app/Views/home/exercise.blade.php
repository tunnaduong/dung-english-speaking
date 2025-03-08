@extends('layouts.home', ['active' => 2])

@section('title', 'Exercises | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill text-white">
                <h2 class="fw-bold zoom">Hi {{ getLastWord(session('user')['name']) }}, Good Afternoon!</h2>
                <p class="m-0 zoom">You can do your homeworks and tests here.<br>
                    Keep it up and improve your progress.</p>
            </div>
            <div class="w-200">
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4 exercise-menu">
        <a class="btn btn-exercise" href="{{ route('exercises/homeworks') }}">Homeworks</a>
        <a class="btn btn-exercise mt-2" href="{{ route('exercises/tests') }}">Tests</a>
    </div>
@endsection
