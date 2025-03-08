@extends('layouts.app')

@section('title', 'Login | DungES')

@section('content')
    <div class="container-auth mt-5 mb-3 d-flex flex-column">
        <div class="row g-0 rounded-4 overflow-hidden">
            <div class="col-lg-6 d-none d-lg-block" style="max-height: 560px; overflow: hidden;">
                <img src="{{ asset('girl.png') }}" style="max-height: 50vw; width: 100%; object-fit: cover;"
                    class="h-auto img-fluid">
            </div>
            <div class="col-12 col-lg-6 bg-color p-5 d-flex align-items-center justify-content-center">
                <div class="login-container">
                    <h1 class="fw-bolder">Log In</h1>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="position-relative">
                                <input type="email" placeholder="Enter your Email"
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
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative">
                                <input type="password" placeholder="Enter your Password"
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
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        Remember Me
                                    </label>
                                </div>
                                <div>
                                    <a href="{{ route('forgot-password') }}" class="text-decoration-none text-black">Forgot
                                        password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <button type="submit" class="btn btn-danger btn-lg bg-primary col-16">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
