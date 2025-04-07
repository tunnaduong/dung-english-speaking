@extends('layouts.admin', ['active' => 2])

@section('title', 'Edit Student | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Students</h4>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 mb-3">
                <div>
                    <h4 class="fw-bold">
                        <a href="{{ route('students') }}" class="back-link">
                            Students</a>/Edit
                    </h4>
                    <div class="line-bottom"></div>
                </div>
            </div>
            @include('_flash')
            <form action="" method="POST">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <div>
                            <label for="full_name" class="form-label fs-09"><img src="{{ asset('person_outline.svg') }}">
                                Full
                                Name</label>
                            <input type="text" name="name" id="full_name" class="form-control"
                                value="{{ $student['name'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="dob" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Date of Birth</label>
                            <input type="date" name="DoB" id="dob" class="form-control"
                                value="{{ $student['DoB'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="email" class="form-label fs-09"><img src="{{ asset('mail.svg') }}">
                                Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $student['email'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="phone" class="form-label fs-09"><img src="{{ asset('phone.svg') }}">
                                Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="0{{ $student['phone'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="password" class="form-label fs-09">
                                Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                value="{{ $student['password'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="id" class="form-label fs-09"><img src="{{ asset('boy.svg') }}">
                                Gender</label>
                            <div class="d-flex gap-4">
                                <div>
                                    <input class="form-check-input" type="radio" name="gender" value="Male"
                                        id="genderMale" {{ $student['gender'] == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">
                                        Male
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="gender" value="Female"
                                        id="genderFemale" {{ $student['gender'] == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="class" class="form-label fs-09">
                                Class</label>
                            <select name="class_id" id="class" class="form-select">
                                <option disabled selected>Choose one</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class['id'] }}"
                                        {{ $class['id'] == $student['class_id'] ? 'selected' : '' }}>
                                        {{ $class['class_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 gap-4">
                    <a href="{{ route('students') }}" class="btn-classroom px-4">Cancel</a>
                    <button type="submit" class="btn-classroom px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
