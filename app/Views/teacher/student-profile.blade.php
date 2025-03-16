@extends('layouts.teacher', ['active' => 3])

@section('title', 'Student Profile | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill">
                <h2 class="text-white fw-bold zoom">Hi {{ getLastWord(session('user')['name']) }}, Good Afternoon!</h2>
                <p>&nbsp;</p>
            </div>
            <div class="w-200">
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 mt-4 bg-white rounded-4 p-4">
        <div>
            <h4 class="fw-bold"><a href="{{ route('students') }}" class="back-link">
                    < Students</a>/Profile
            </h4>
            <div class="line-bottom"></div>
        </div>
        <div class="rounded-4 border-line mt-3 p-3 px-4 d-flex align-items-center">
            <img src="{{ asset('person.svg') }}" class="img-fluid img-user me-3">
            <div class="flex-fill overflow-hidden">
                <h5 class="fw-bold">Hai My</h5>
                <div class="fs-09 mb-2 text-truncate">
                    myhainguyen02@gmail.com</div>
                <div class="fs-09 text-truncate">0392323232</div>
            </div>
        </div>
        <form action="{{ route('students/' . $id . '/profile/update') }}" method="POST" class="m-0 mt-3">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="full_name" class="form-label fs-09"><img src="{{ asset('person_outline.svg') }}">
                            Full
                            Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control"
                            value="Nguyen Thi Hai My">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="dob" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                            Date of
                            birth</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="2003-03-02">
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="email" class="form-label fs-09"><img src="{{ asset('mail.svg') }}" class="ms-1 me-1">
                            Email</label>
                        <input disabled type="text" name="email" id="email" class="form-control"
                            value="myhainguyen02@gmail.com">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="phone" class="form-label fs-09"><img src="{{ asset('phone.svg') }}"
                                style="width: 20px; height: 20px;">
                            Phone number</label>
                        <input disabled type="text" id="phone" name="phone" class="form-control"
                            value="0392323232">
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-light bg-white btn-update rounded-4">Update</button>
            </div>
        </form>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div>
            <h4 class="fw-bold">Class</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="table-responsive my-3">
            <table class="table table-custom table-big table-sticky table-horizontal m-0">
                <thead class="overflow-hidden">
                    <tr>
                        <th>Class</th>
                        <th>Date Started</th>
                        <th>Learning Outcomes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pre IELTS 01</td>
                        <td>01/02/2025</td>
                        <td><a href="{{ route('students/1/class/1') }}">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
