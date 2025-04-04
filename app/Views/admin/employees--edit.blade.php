@extends('layouts.admin', ['active' => 1])

@section('title', 'Edit Employee | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Employees</h4>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 mb-3">
                <div>
                    <h4 class="fw-bold">
                        <a href="{{ route('employees') }}" class="back-link">
                            < Employees</a>/Edit
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
                                value="{{ $employee['name'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="dob" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Date of Birth</label>
                            <input type="date" name="DoB" id="dob" class="form-control"
                                value="{{ $employee['DoB'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="email" class="form-label fs-09"><img src="{{ asset('mail.svg') }}">
                                Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $emp['email'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="phone" class="form-label fs-09"><img src="{{ asset('phone.svg') }}">
                                Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="0{{ $employee['phone'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="address" class="form-label fs-09"><img src="{{ asset('location_on.svg') }}">
                                Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ $employee['address'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="role" class="form-label fs-09"><img src="{{ asset('info.svg') }}">
                                Role</label>
                            <select name="role_id" id="role" class="form-select">
                                @foreach ($roles as $role)
                                    <option {{ $employee['role_id'] == $role['role_id'] ? 'selected' : '' }}
                                        value="{{ $role['role_id'] }}">{{ $role['role'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="id" class="form-label fs-09"><img src="{{ asset('person_pin.svg') }}">
                                ID Number</label>
                            <input type="text" name="personal_id" id="id" class="form-control"
                                value="{{ $employee['personal_id'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="id" class="form-label fs-09"><img src="{{ asset('boy.svg') }}">
                                Gender</label>
                            <div class="d-flex gap-4">
                                <div>
                                    <input class="form-check-input" type="radio" name="gender" value="Male"
                                        id="genderMale" {{ $employee['gender'] == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">
                                        Male
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" name="gender" value="Female"
                                        id="genderFemale" {{ $employee['gender'] == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 gap-4">
                    <a href="{{ route('employees') }}" class="btn-classroom px-4">Cancel</a>
                    <button type="submit" class="btn-classroom px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
