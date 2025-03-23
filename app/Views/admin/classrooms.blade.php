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
            <a href="{{ route('classrooms/pre01/curriculum/add') }}" class="btn-classroom px-3 w-auto"><img
                    src="{{ asset('add.svg') }}" class="me-2" />Add new</a>
        </div>
        <div class="classroom-container gap-4 mt-4">
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold">PRE01</h5>
                        <div class="fw-semi">Pre IELTS 01 - 27 lectures</div>
                        <div>Teacher: Hoàng Tiến Dũng</div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('classrooms/pre01/list') }}"><img src="{{ asset('edit.svg') }}"></a>
                        <a href="{{ route('classrooms/pre01/curriculum') }}"><img src="{{ asset('delete.svg') }}"></a>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('classrooms/pre01/list') }}" class="btn-classroom">List</a>
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold">PRE02</h5>
                        <div class="fw-semi">Pre IELTS 02 - 27 lectures</div>
                        <div>Teacher: Hoàng Tiến Dũng</div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('classrooms/pre01/list') }}"><img src="{{ asset('edit.svg') }}"></a>
                        <a href="{{ route('classrooms/pre01/curriculum') }}"><img src="{{ asset('delete.svg') }}"></a>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('classrooms/pre01/list') }}" class="btn-classroom">List</a>
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold">BEGINNER01</h5>
                        <div class="fw-semi">Beginner 4.0 01 - 27 lectures</div>
                        <div>Teacher: Hoàng Tiến Dũng</div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('classrooms/pre01/list') }}"><img src="{{ asset('edit.svg') }}"></a>
                        <a href="{{ route('classrooms/pre01/curriculum') }}"><img src="{{ asset('delete.svg') }}"></a>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('classrooms/pre01/list') }}" class="btn-classroom">List</a>
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold">BEGINNER02</h5>
                        <div class="fw-semi">Beginner 4.0 02 - 27 lectures</div>
                        <div>Teacher: Hoàng Tiến Dũng</div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('classrooms/pre01/list') }}"><img src="{{ asset('edit.svg') }}"></a>
                        <a href="{{ route('classrooms/pre01/curriculum') }}"><img src="{{ asset('delete.svg') }}"></a>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('classrooms/pre01/list') }}" class="btn-classroom">List</a>
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold">BEGINNER03</h5>
                        <div class="fw-semi">Beginner 4.0 03 - 27 lectures</div>
                        <div>Teacher: Hoàng Tiến Dũng</div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('classrooms/pre01/list') }}"><img src="{{ asset('edit.svg') }}"></a>
                        <a href="{{ route('classrooms/pre01/curriculum') }}"><img src="{{ asset('delete.svg') }}"></a>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('classrooms/pre01/list') }}" class="btn-classroom">List</a>
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
            <div class="border-line p-4 rounded-4 m-2 classroom">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="fw-bold">UPPER01</h5>
                        <div class="fw-semi">Upper 5.0 01 - 27 lectures</div>
                        <div>Teacher: Hoàng Tiến Dũng</div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('classrooms/pre01/list') }}"><img src="{{ asset('edit.svg') }}"></a>
                        <a href="{{ route('classrooms/pre01/curriculum') }}"><img src="{{ asset('delete.svg') }}"></a>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-between mt-3">
                    <a href="{{ route('classrooms/pre01/list') }}" class="btn-classroom">List</a>
                    <a href="{{ route('classrooms/pre01/curriculum') }}" class="btn-classroom">Curriculum</a>
                </div>
            </div>
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
