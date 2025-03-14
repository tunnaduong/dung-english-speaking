@extends('layouts.teacher', ['active' => 1])

@section('title', 'Add Curriculum | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Beginner 4.0 - 27 lectures</h4>
        </div>
        <div>
            <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/<a
                    href="{{ route('classrooms/pre01/curriculum') }}" class="back-link">Curriculum</a>/Create
            </h4>
            <div class="line-bottom"></div>
        </div>
        <div class="my-4">
            <table class="w-100">
                <tr>
                    <td style="width: 150px">
                        <div class="mb-3">Session ID</d>
                    </td>
                    <td>
                        <div class="session-id mb-3">BG01028</div>
                    </td>
                </tr>
                <tr>
                    <td class="align-baseline">
                        <div class="mb-3 mt-2">Topic</div>
                    </td>
                    <td>
                        <textarea name="topic" id="topic" placeholder="Add topic..." class="form-control rounded-35 mb-3 bg-light"
                            rows="3"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="mb-3">Date</div>
                    </td>
                    <td>
                        <input type="date" id="date" name="date"
                            class="form-control w-200 mb-3 rounded-35 bg-light" value="2025-03-02">
                    </td>
                </tr>
                <tr>
                    <td>Exercise</td>
                    <td>
                        <select class="form-select w-200 rounded-35 bg-light">
                            <option value="listen1">Listening 1</option>
                            <option value="listen2">Listening 2</option>
                            <option value="listen3">Listening 3</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="d-flex justify-content-end gap-4">
            <button class="btn-classroom px-4 w-auto">Create</button>
            <a class="btn-classroom px-4 w-auto" href="{{ route('classrooms/pre01/curriculum') }}">Cancel</a>
        </div>
    </div>
@endsection
