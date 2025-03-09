@extends('layouts.home', ['active' => 3])

@section('title', 'Absence | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill text-white">
                <h2 class="fw-bold zoom">Hi {{ getLastWord(session('user')['name']) }}, Good Afternoon!</h2>
                <p class="m-0 zoom">You've learned 70% of your goal this week!<br>
                    Keep it up and improve your progress.</p>
            </div>
            <div class="w-200">
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4 exercise-menu">
        <div>
            <h4 class="fw-bold"><a href="{{ route('absence') }}" class="back-link">Absence</a>/Leave of
                absence
            </h4>
            <div class="line-bottom"></div>
        </div>
        <form action="{{ route('absence/leave/store') }}" id="leaveForm" method="POST" class="m-0 mt-3">
            <input type="hidden" name="token" value="{{ bin2hex(random_bytes(16)) }}">
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <div>
                        <label for="dob" class="form-label fs-09 fw-bold"><img src="{{ asset('calendar_month.svg') }}">
                            Day off</label>
                        <input type="date" id="dob" name="dob" class="form-control"
                            value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label fs-09 fw-bold">Reasons for absence</label>
                <textarea class="form-control rounded-4" id="reason" name="reason" rows="8"></textarea>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#leaveModal"
                    class="btn btn-more fw-bold btn-send">Send request</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Sign up for compensation?</h5>
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-confirm" onclick="submitForm()">Yes</button>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById("leaveForm").submit();
        }
    </script>
@endpush
