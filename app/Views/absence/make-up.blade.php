@extends('layouts.home', ['active' => 3])

@section('title', 'Make Up | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill text-white">
                <h2 class="fw-bold zoom">Dũng English Speaking</h2>
                <p class="m-0 zoom">You've learned 70% of your goal this week!<br>
                    Keep it up and improve your progress.</p>
            </div>
            <div>
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4 exercise-menu">
        <div>
            <h4 class="fw-bold"><a href="{{ route('absence') }}" class="back-link">Absence</a>/<a
                    href="{{ route('absence/leave') }}" class="back-link">Leave of absence</a>/Make up</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-big">
                <thead class="overflow-hidden">
                    <tr>
                        <th>ID Class</th>
                        <th>Class Name</th>
                        <th>Date</th>
                        <th>Shift</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($makeUpData as $class)
                        <tr>
                            <td>{{ $class['class_id'] }}</td>
                            <td>{{ $class['class_name'] }}</td>
                            <td>{{ date('d/m/Y', strtotime($class['date'])) }}</td>
                            <td>{{ $class['shift'] }}</td>
                            <td><a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                    data-bs-target="#enrollModal{{ $class['class_id'] }}">Enroll</a></td>
                        </tr>
                        @push('scripts')
                            <!-- Bootstrap 5 Modal -->
                            <div class="modal fade" id="enrollModal{{ $class['class_id'] }}" tabindex="-1"
                                aria-labelledby="enrollModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header p-2">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h5 class="fw-semi mb-4">Choose this class?</h5>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('absence/leave/make-up/' . $class['class_id'] . '?id=' . request()->input('id')) }}"
                                                    class="btn btn-confirm">Yes</a>
                                                <button type="button" class="btn btn-confirm"
                                                    data-bs-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endpush
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
