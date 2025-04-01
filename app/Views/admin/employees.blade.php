@extends('layouts.admin', ['active' => 1])

@section('title', 'Employees | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">Employees</h4>
        </div>
        <div>
            <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold">Employees</h4>
                    <div class="line-bottom"></div>
                </div>
                <form action="" class="position-relative m-0">
                    <img src="{{ asset('search.svg') }}" class="search-icon">
                    <input type="text" placeholder="Searching" class="search-input form-control form-control-lg"
                        id="search" name="search" value="{{ $_GET['search'] }}">
                </form>
            </div>
            {{-- Table --}}
            <div class="table-responsive my-3">
                <table class="table table-custom table-big table-sticky table-horizontal m-0">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>ID Personnel</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee['id'] }}</td>
                                <td>{{ $employee['name'] }}</td>
                                <td>{{ $employee['gender'] }}</td>
                                <td>0{{ $employee['phone'] }}</td>
                                <td>{{ $employee['role'] }}</td>
                                <td><a href="{{ route('employees/' . $employee['id'] . '/edit') }}" class="me-2">
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
                                                <h5 class="fw-semi mb-4">Do you want to delete this employee?</h5>
                                                <div class="d-flex justify-content-around">
                                                    <a class="btn btn-confirm"
                                                        href="{{ route('employees/' . $employee['id'] . '/delete') }}">Yes</a>
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
            <div class="d-flex justify-content-end">
                <a href="{{ route('employees/add') }}" class="btn-classroom px-4">Add</a>
            </div>
        </div>
    </div>
@endsection
