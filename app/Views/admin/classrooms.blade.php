@extends('layouts.admin', ['active' => 0])

@section('title', 'Classrooms | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <h4 class="fw-bold m-0 flex-shrink-0">CLASSROOMS</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('classrooms/pre01/add') }}" class="btn-classroom px-3 w-auto"><img
                    src="{{ asset('add.svg') }}" class="me-2" />Add new</a>
        </div>
        <div class="row justify-content-center gap-4 mt-4">
            @foreach ($classrooms as $classroom)
                <div class="col-md-6 border-line p-4 rounded-4 m-2 classroom">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="fw-bold">{{ $classroom['class_name'] }}</h5>
                            <div class="fw-semi">{{ $classroom['course_name'] }} - {{ $classroom['NoL'] }} lectures
                            </div>
                            <div>Teacher: {{ $classroom['name'] }}</div>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ route('classrooms/' . $classroom['class_id'] . '/edit') }}"><img
                                    src="{{ asset('edit.svg') }}"></a>
                            <a href="{{ route('classrooms/' . $classroom['class_id'] . '/delete') }}"><img
                                    src="{{ asset('delete.svg') }}"></a>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-between mt-3">
                        <a href="{{ route('classrooms/' . $classroom['class_id'] . '/list') }}"
                            class="btn-classroom">List</a>
                        <a href="{{ route('classrooms/' . $classroom['class_id'] . '/curriculum') }}"
                            class="btn-classroom">Curriculum</a>
                        <a href="{{ route('classrooms/' . $classroom['class_id'] . '/assign') }}"
                            class="btn-classroom">Assign</a>
                    </div>
                </div>
            @endforeach
        </div>
        <nav class="d-flex justify-content-center mt-3">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link w-40" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link w-40" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link w-40" href="#">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
