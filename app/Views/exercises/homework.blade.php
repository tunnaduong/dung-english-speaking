@extends('layouts.home', ['active' => 2])

@section('title', 'Homeworks | DungES')

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
        <a class="text-decoration-none btn-back underline-hover fs-5" href="{{ route('exercises') }}">
            < Exercises</a>
                <div class="btn-exercise mt-4">Homeworks</div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead class="overflow-hidden">
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Scores</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($homeworks as $homework)
                                <tr>
                                    <td>{{ $homework['name'] }}</td>
                                    <td>{{ date('d/m/Y', strtotime($homework['deadline'])) }}</td>
                                    <td>Done</td>
                                    <td>90/100</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </div>
@endsection
