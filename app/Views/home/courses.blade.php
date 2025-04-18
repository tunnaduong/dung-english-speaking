@extends('layouts.home', ['active' => 1])

@section('title', 'Courses | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill">
                <h2 class="text-white fw-bold zoom">Dũng English Speaking</h2>
                <p>&nbsp;</p>
            </div>
            <div>
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 mt-4 bg-white rounded-4 p-4">
        <div>
            <h4 class="fw-bold">My Courses</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6 col-12">
                    <div class="rounded-4 border-line mt-3">
                        <div class="p-3 px-4">
                            <div class="fw-bold fs-5 text-decoration-none text-black">{{ $course['class_name'] }} -
                                {{ $course['NoL'] }}
                                lectures</div>
                            <div class="progress-text">25%</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="p-3 px-4 d-flex justify-content-center align-items-center">
                            <a href="{{ route('courses/' . $course['c_id']) }}" class="btn-classroom">Curriculum</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
