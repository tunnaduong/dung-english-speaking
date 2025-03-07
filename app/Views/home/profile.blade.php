@extends('layouts.home')

@section('title', 'Home | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div>
                <h2 class="text-white fw-bold">Hi My, Good Afternoon!</h2>
                <p>&nbsp;</p>
            </div>
            <img src="{{ asset('hero.png') }}" class="hero-img">
        </div>
    </div>
@endsection
