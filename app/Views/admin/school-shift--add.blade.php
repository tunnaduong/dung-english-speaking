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
                            <label for="start_time" class="form-label fs-09"><img src="{{ asset('person_outline.svg') }}">
                                Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control"
                                value="{{ old('start_time') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="end_time" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control"
                                value="{{ old('end_time') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="day_of_week" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                Day of Week</label>
                            <select name="day_of_week" id="day_of_week" class="form-select">
                                <option value="" disabled selected>Select Day of Week</option>
                                <option value="Monday" {{ old('day_of_week') == 'Monday' ? 'selected' : '' }}>Monday
                                </option>
                                <option value="Tuesday" {{ old('day_of_week') == 'Tuesday' ? 'selected' : '' }}>Tuesday
                                </option>
                                <option value="Wednesday" {{ old('day_of_week') == 'Wednesday' ? 'selected' : '' }}>
                                    Wednesday</option>
                                <option value="Thursday" {{ old('day_of_week') == 'Thursday' ? 'selected' : '' }}>Thursday
                                </option>
                                <option value="Friday" {{ old('day_of_week') == 'Friday' ? 'selected' : '' }}>Friday
                                </option>
                                <option value="Saturday" {{ old('day_of_week') == 'Saturday' ? 'selected' : '' }}>Saturday
                                </option>
                                <option value="Sunday" {{ old('day_of_week') == 'Sunday' ? 'selected' : '' }}>Sunday
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
