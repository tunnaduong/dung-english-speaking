@extends('layouts.teacher', ['active' => 1])

@section('title', 'Classroom Curriculum | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">{{ $course['course_name'] }} - {{ $course['NoL'] }} lectures</h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg" id="search"
                    name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="fw-bold"><a href="{{ route('classrooms') }}" class="back-link">Classrooms</a>/Curriculum
                    </h4>
                    <div class="line-bottom"></div>
                </div>
                <a href="{{ route("classrooms/$id/curriculum/add") }}" class="btn-classroom px-3 w-auto"><img
                        src="{{ asset('add.svg') }}" class="me-2" />Add new</a>
            </div>
            <div class="table-responsive my-3">
                <table class="table table-custom table-big table-sticky table-horizontal m-0">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>No.</th>
                            <th>Session</th>
                            <th>Topic</th>
                            <th style="min-width: 135px;">Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($curriculums as $curriculum)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $curriculum['c_id'] }}</td>
                                <td>{{ $curriculum['topic'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($curriculum['c_created_at'])) }}</td>
                                <td><a href="{{ route('classrooms/' . $id . '/curriculum/' . $curriculum['c_id'] . '/edit') }}"
                                        class="me-2">
                                        <img src="{{ asset('edit.svg') }}" /></a><button class="btn-custom"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}"><img
                                            src="{{ asset('delete.svg') }}" /></button>
                                </td>
                            </tr>
                            @push('scripts')
                                <!-- Bootstrap 5 Modal -->
                                <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header p-2">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h5 class="fw-semi mb-4">Do you want to delete this lecture?</h5>
                                                <div class="d-flex justify-content-around">
                                                    <a class="btn btn-confirm"
                                                        href="{{ route('classrooms/' . $id . '/curriculum/' . $curriculum['c_id'] . '/delete') }}">Yes</a>
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
            <nav class="d-flex justify-content-center">
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
    </div>
@endsection
