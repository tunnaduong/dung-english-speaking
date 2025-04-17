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
                            < Employees</a>/{{ $employee['name'] }}/Edit
                    </h4>
                    <div class="line-bottom"></div>
                </div>
            </div>
            @include('_flash')
            <form action="" method="POST" id="submit_form">
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
            </form>
            <div class="d-flex justify-content-center mt-5 gap-4">
                <button class="btn-classroom px-4" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                <button class="btn-classroom px-4" data-bs-toggle="modal" data-bs-target="#saveConfirmModal">Save</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="cancelModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to cancel?</h5>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-confirm" href="{{ route('employees') }}">Yes</a>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="saveConfirmModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to save?</h5>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-confirm" onclick="submitForm()">Yes</button>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById("submit_form").submit();
        }
    </script>
@endpush
