@extends('layouts.app')

@section('title', 'Reset Password | DungES')

@section('content')
    <div class="container-auth mt-5 mb-3 d-flex flex-column">
        <div class="row g-0 rounded-4 overflow-hidden">
            <div class="col-lg-6 d-none d-lg-block" style="max-height: 560px; overflow: hidden;">
                <img src="{{ asset('girl.png') }}" style="max-height: 50vw; width: 100%; object-fit: cover;"
                    class="h-auto img-fluid">
            </div>
            <div class="col-12 col-lg-6 bg-color p-5 d-flex align-items-center justify-content-center">
                <div class="login-container">
                    <h1 class="fw-bolder">Confirm New Password</h1>
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">Enter a new Password</label>
                            <div class="position-relative">
                                <input type="password" placeholder="New Password"
                                    class="auth-input form-control form-control-lg {{ $errors['password'] ?? null ? 'is-invalid' : '' }}"
                                    id="password" name="password" value="{{ $_POST['password'] }}">
                                @if (isset($errors['password']))
                                    <div class="invalid-feedback">{{ $errors['password'] }}</div>
                                @endif
                                @if (!isset($errors['password']))
                                    <img src="{{ asset('lock.png') }}" class="auth-icon">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <div class="position-relative">
                                <input type="password" placeholder="Confirm Password"
                                    class="auth-input form-control form-control-lg {{ $errors['confirm_password'] ?? null ? 'is-invalid' : '' }}"
                                    id="confirm_password" name="confirm_password" value="{{ $_POST['confirm_password'] }}">
                                @if (isset($errors['confirm_password']))
                                    <div class="invalid-feedback">{{ $errors['confirm_password'] }}</div>
                                @endif
                                @if (!isset($errors['confirm_password']))
                                    <img src="{{ asset('lock.png') }}" class="auth-icon">
                                @endif
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <button type="submit" class="btn btn-danger btn-lg bg-primary col-16">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <img src="{{ asset('check.svg') }}" class="my-3">
                    <h4 class="fw-bold">Done!</h4>
                    <p class="mb-0">{{ $success['success'] ?? '' }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-danger bg-primary dismiss-btn">GO
                        TO
                        LOGIN</a>
                </div>
            </div>
        </div>
    </div>

    @if (isset($success['success']))
        <!-- JavaScript to Show Modal Automatically -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();
            });
        </script>
    @endif
@endsection
