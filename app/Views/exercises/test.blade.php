@extends('layouts.home', ['active' => 2])

@section('title', 'Tests | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill text-white">
                <h2 class="fw-bold zoom">Dũng English Speaking</h2>
                <p class="m-0 zoom">You can do your homeworks and tests here.<br>
                    Keep it up and improve your progress.</p>
            </div>
            <div>
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4 exercise-menu">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ route('exercises') }}">
                < Exercise</a>/Tests
        </div>
        <div class="d-flex gap-3 justify-content-start mt-4">
            <a href="?type=reading" class="btn-skill @if (request()->input('type') == 'reading' || !request()->input('type')) btn-skill-active @endif">
                Reading
            </a>
            <a href="?type=writing" class="btn-skill @if (request()->input('type') == 'writing') btn-skill-active @endif">
                Writing
            </a>
            <a href="?type=listening" class="btn-skill @if (request()->input('type') == 'listening') btn-skill-active @endif">
                Listening
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead class="overflow-hidden">
                    <tr>
                        <th>Name</th>
                        <th>Date submitted</th>
                        <th>Time spent</th>
                        <th>Scores</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $homework)
                        <tr>
                            <td>{{ $homework['name'] }}</td>
                            <td>
                                @if ($homework['date'])
                                    <div>{{ date('d/m/Y', strtotime($homework['date'])) }}</div>
                                    <div class="text-muted">{{ date('H:i:s', strtotime($homework['date'])) }}</div>
                                @else
                                    <span>Not Submitted</span>
                                @endif
                            </td>
                            <td>
                                @if ($homework['time_spent'])
                                    {{ date('i:s', strtotime($homework['time_spent'])) }}
                                @else
                                    <span>00:00</span>
                                @endif
                            </td>
                            <td>{{ $homework['score'] !== null ? round($homework['score'], 1) : '0' }}</td>
                            <td>
                                @if ($homework['date'] !== null)
                                    <a href="{{ route('exercises/tests/' . $homework['exercise_id']) }}">Redo</a>
                                @else
                                    <a href="{{ route('exercises/tests/' . $homework['exercise_id']) }}">Do</a>
                                @endif
                            </td>
                            <td>
                                @if ($homework['date'] !== null)
                                    <a href="#">Review</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
