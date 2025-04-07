@extends('layouts.admin', ['active' => 0])

@section('title', 'Classroom Assign | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">{{ $course['course_name'] }} - {{ $course['NoL'] }} lectures</h4>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 mb-3">
                <div>
                    <h4 class="fw-bold">
                        <a href="{{ route('classrooms') }}" class="back-link">
                            Classrooms</a>/Assign
                    </h4>
                    <div class="line-bottom"></div>
                </div>
            </div>
            @include('_flash')
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <label for="teacher">Teacher:</label>
                    </div>
                    <div class="col-md-6">
                        <select name="teacher_id" id="teacher" class="form-select w-100 rounded-35 bg-light mb-3">
                            <option disabled {{ $class['teacher_id'] == null ? 'selected' : '' }}>Choose one</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher['id'] }}"
                                    {{ $class['teacher_id'] == $teacher['id'] ? 'selected' : '' }}>
                                    {{ $teacher['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <label for="ta">Teaching Assistant:</label>
                    </div>
                    <div class="col-md-6">
                        <select name="assistant_id" id="ta" class="form-select w-100 rounded-35 bg-light mb-3">
                            <option disabled {{ $class['assistant_id'] == null ? 'selected' : '' }}>Choose one</option>
                            @foreach ($tas as $ta)
                                <option value="{{ $ta['id'] }}"
                                    {{ $class['assistant_id'] == $ta['id'] ? 'selected' : '' }}>
                                    {{ $ta['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="d-flex justify-content-center mt-5 gap-4">
                    <a href="{{ route('classrooms') }}" class="btn-classroom px-4">Cancel</a>
                    <button type="submit" class="btn-classroom px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
