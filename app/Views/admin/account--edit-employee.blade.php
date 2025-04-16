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
                    <h4 class="fw-bold"><a href="{{ route('account') }}" class="back-link">
                            < {{ $employee2['name'] }}</a>/Edit
                    </h4>
                    <div class="line-bottom"></div>
                </div>
            </div>
        </div>
        @include('_flash')
        <form action="" method="POST" id="editAccountForm">
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
        </form>
        <div class="d-flex justify-content-center mt-5 gap-4">
            <button class="btn-classroom px-4" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
            <button class="btn-classroom px-4" data-bs-toggle="modal" data-bs-target="#saveConfirmModal">Save</button>
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
                        <a class="btn btn-confirm" href="{{ route('account') }}">Yes</a>
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
            document.getElementById("editAccountForm").submit();
        }
    </script>
@endpush
