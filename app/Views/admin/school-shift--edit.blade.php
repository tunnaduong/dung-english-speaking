@extends('layouts.admin', ['active' => 4])

@section('title', 'Add School Shift | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">School Shift</h4>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 mb-3">
                <div>
                    <h4 class="fw-bold">
                        <a href="{{ route('school-shift') }}" class="back-link">
                            < School Shift</a>/Add
                    </h4>
                    <div class="line-bottom"></div>
                </div>
            </div>
            @include('_flash')
            <form action="" method="POST" id="addSchoolShiftForm">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <div>
                            <label for="shift1" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Shift 1</label>
                            <input type="number" min="1" max="10" name="shift1" id="shift1"
                                class="form-control" value="{{ $shift['shift1'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="shift2" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Shift 2</label>
                            <input type="number" min="1" max="10" name="shift2" id="shift2"
                                class="form-control" value="{{ $shift['shift2'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="day_of_week" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Day of Week 1</label>
                            <select name="day_of_week1" id="day_of_week" class="form-select">
                                <option value="" disabled selected>Select Day of Week</option>
                                <option value="Monday" {{ $shift['day_of_week1'] == 'Monday' ? 'selected' : '' }}>Monday
                                </option>
                                <option value="Tuesday" {{ $shift['day_of_week1'] == 'Tuesday' ? 'selected' : '' }}>Tuesday
                                </option>
                                <option value="Wednesday" {{ $shift['day_of_week1'] == 'Wednesday' ? 'selected' : '' }}>
                                    Wednesday</option>
                                <option value="Thursday" {{ $shift['day_of_week1'] == 'Thursday' ? 'selected' : '' }}>
                                    Thursday
                                </option>
                                <option value="Friday" {{ $shift['day_of_week1'] == 'Friday' ? 'selected' : '' }}>Friday
                                </option>
                                <option value="Saturday" {{ $shift['day_of_week1'] == 'Saturday' ? 'selected' : '' }}>
                                    Saturday
                                </option>
                                <option value="Sunday" {{ $shift['day_of_week1'] == 'Sunday' ? 'selected' : '' }}>Sunday
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="day_of_week" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Day of Week 2</label>
                            <select name="day_of_week2" id="day_of_week" class="form-select">
                                <option value="" disabled selected>Select Day of Week</option>
                                <option value="Monday" {{ $shift['day_of_week2'] == 'Monday' ? 'selected' : '' }}>Monday
                                </option>
                                <option value="Tuesday" {{ $shift['day_of_week2'] == 'Tuesday' ? 'selected' : '' }}>Tuesday
                                </option>
                                <option value="Wednesday" {{ $shift['day_of_week2'] == 'Wednesday' ? 'selected' : '' }}>
                                    Wednesday</option>
                                <option value="Thursday" {{ $shift['day_of_week2'] == 'Thursday' ? 'selected' : '' }}>
                                    Thursday
                                </option>
                                <option value="Friday" {{ $shift['day_of_week2'] == 'Friday' ? 'selected' : '' }}>Friday
                                </option>
                                <option value="Saturday" {{ $shift['day_of_week2'] == 'Saturday' ? 'selected' : '' }}>
                                    Saturday
                                </option>
                                <option value="Sunday" {{ $shift['day_of_week2'] == 'Sunday' ? 'selected' : '' }}>Sunday
                                </option>
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
                        <a class="btn btn-confirm" href="{{ route('school-shift') }}">Yes</a>
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
            document.getElementById("addSchoolShiftForm").submit();
        }
    </script>
@endpush
