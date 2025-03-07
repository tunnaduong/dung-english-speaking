@extends('layouts.app')

@section('title', 'Forgot Password | DungES')

@section('content')
    <div class="container-auth my-5 d-flex flex-column">
        <div class="row g-0 rounded-4 overflow-hidden">
            <div class="col-lg-6 d-none d-lg-block" style="max-height: 630px; overflow: hidden;">
                <img src="{{ asset('girl.png') }}" style="max-height: 50vw; width: 100%; object-fit: cover;"
                    class="h-auto img-fluid">
            </div>
            <div class="col-12 col-lg-6 bg-color p-5 d-flex align-items-center justify-content-center">
                <div class="login-container">
                    <h1 class="fw-bolder">Reset Password</h1>
                    <div class="my-4">
                        <p>Enter the email address<br>
                            associated with your account.</p>
                    </div>
                    <form action="{{ route('forgot-password') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="position-relative">
                                <input type="email" placeholder="Enter Email"
                                    class="auth-input form-control form-control-lg {{ $errors['email'] ?? null ? 'is-invalid' : '' }}"
                                    id="email" name="email" value="{{ $_POST['email'] }}">
                                @if (isset($errors['email']))
                                    <div class="invalid-feedback">{{ $errors['email'] }}</div>
                                @endif
                                @if (!isset($errors['email']))
                                    <img src="{{ asset('lock.png') }}" class="auth-icon">
                                @endif
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <button type="submit" class="btn btn-danger btn-lg bg-primary col-16">CONTINUE</button>
                                <span class="text-center mt-3">Return to <a href="{{ route('login') }}"
                                        class="text-decoration-none text-primary">Log In</a></span>
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
                    <h4 class="fw-bold">Link was sent</h4>
                    <p class="mb-0">{{ $success['success'] ?? '' }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger bg-primary dismiss-btn"
                        data-bs-dismiss="modal">CONTINUE</button>
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
