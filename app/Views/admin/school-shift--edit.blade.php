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
            <form action="" method="POST">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <div>
                            <label for="start_time" class="form-label fs-09"><img src="{{ asset('person_outline.svg') }}">
                                Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control"
                                value="{{ $shift['start_time'] }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="end_time" class="form-label fs-09"><img src="{{ asset('calendar_month.svg') }}">
                                End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control"
                                value="{{ $shift['end_time'] }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 gap-4">
                    <a href="{{ route('school-shift') }}" class="btn-classroom px-4">Cancel</a>
                    <button type="submit" class="btn-classroom px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
