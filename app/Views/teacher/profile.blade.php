@extends('layouts.teacher', ['active' => 0])

@section('title', 'My Profile | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill">
                <h2 class="text-white fw-bold zoom">Dũng English Speaking</h2>
                <p class="m-0 zoom">&nbsp;</p>
            </div>
            <div>
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div>
            <h4 class="fw-bold">My Profile</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="rounded-4 border-line mt-3 p-3 px-4 d-flex align-items-center">
            <img src="{{ asset('person.svg') }}" class="img-fluid img-user me-3">
            <div class="flex-fill overflow-hidden">
                <h5 class="fw-bold">{{ getLastTwoWords(session('user')['name']) }}</h5>
                <div class="fs-09 mb-2 text-truncate">
                    {{ $profile['email'] }}</div>
                <div class="fs-09 text-truncate">0{{ $profile['phone'] }}</div>
            </div>
        </div>
        <form action="{{ route('profile/update') }}" method="POST" class="m-0 mt-3">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="full_name" class="form-label fs-09"><img src="{{ asset('person_outline.svg') }}">
                            Full
                            Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control"
                            value="{{ $profile['name'] }}">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="dob" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                            Date of
                            birth</label>
                        <input type="date" id="dob" name="dob" class="form-control"
                            value="{{ $profile['DoB'] }}">
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="email" class="form-label fs-09"><img src="{{ asset('mail.svg') }}"
                                class="ms-1 me-1">
                            Email</label>
                        <input disabled type="text" name="email" id="email" class="form-control"
                            value="{{ $profile['email'] }}">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="phone" class="form-label fs-09"><img src="{{ asset('phone.svg') }}"
                                style="width: 20px; height: 20px;">
                            Phone number</label>
                        <input disabled type="text" id="phone" name="phone" class="form-control"
                            value="0{{ $profile['phone'] }}">
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-light bg-white btn-update rounded-4">Update</button>
            </div>
        </form>
    </div>
@endsection
