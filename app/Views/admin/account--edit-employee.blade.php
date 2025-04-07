@extends('layouts.admin', ['active' => 5])

@section('title', 'Edit Account | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Account</h4>
        </div>
        <div>
            <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold"><a href="{{ route('accounts') }}" class="back-link">
                            < {{ $employee2['name'] }}</a>/Edit
                    </h4>
                    <div class="line-bottom"></div>
                </div>
            </div>
        </div>
        @include('_flash')
        <form action="" method="POST">
            <div class="row gy-3">
                <div class="col-md-6">
                    <div>
                        <label for="email" class="form-label fs-09"><img src="{{ asset('mail.svg') }}">
                            Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ $employee['email'] }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="password" class="form-label fs-09"><img src="{{ asset('person_outline.svg') }}">
                            Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            value="{{ $employee['password'] }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="status" class="form-label fs-09"><img src="{{ asset('info.svg') }}">
                            Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active">Activate</option>
                            <option value="deactivated">Deactivated</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="role" class="form-label fs-09"><img src="{{ asset('info.svg') }}">
                            Role</label>
                        <select name="role_id" id="role" class="form-select">
                            @foreach ($roles as $role)
                                <option value="{{ $role['role_id'] }}"
                                    {{ $employee2['role_id'] == $role['role_id'] ? 'selected' : '' }}>{{ $role['role'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5 gap-4">
                <a href="{{ route('account') }}" class="btn-classroom px-4">Cancel</a>
                <button type="submit" class="btn-classroom px-4">Save</button>
            </div>
        </form>
    </div>
@endsection
