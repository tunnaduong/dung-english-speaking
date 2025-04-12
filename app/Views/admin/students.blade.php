@extends('layouts.admin', ['active' => 2])

@section('title', 'Students | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div>
            <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h4 class="fw-bold">Students</h4>
                    <div class="line-bottom"></div>
                </div>
                <form action="" class="position-relative m-0">
                    <img src="{{ asset('search.svg') }}" class="search-icon">
                    <input type="text" placeholder="Searching" class="search-input form-control form-control-lg"
                        id="search" name="search" value="{{ $_GET['search'] }}">
                </form>
            </div>
            {{-- Table --}}
            <div class="table-responsive table-limit-height my-3">
                <table id="data-table" class="table table-custom table-big table-sticky table-horizontal"
                    style="white-space: nowrap">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>No.</th>
                            <th>ID Student</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Phone</th>
                            <th>Class</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students['data'] as $employee)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $employee['s_id'] }}</td>
                                <td>{{ $employee['name'] }}</td>
                                <td>{{ $employee['gender'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($employee['DoB'])) }}</td>
                                <td>0{{ $employee['phone'] }}</td>
                                <td>{{ $employee['class_name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('components.pagination', [
                'current_page' => $students['current_page'],
                'last_page' => $students['last_page'],
            ])
            <div class="d-flex justify-content-end gap-4">
                <a href="{{ route('students/add') }}" class="btn-classroom px-3 w-auto"><img src="{{ asset('add.svg') }}"
                        class="me-2" />Add new</a>
                <a href="#" class="btn-classroom btn-edit px-3 btn-disabled"><img src="{{ asset('edit.svg') }}"
                        width="15" class="me-2" />Edit</a>
                <button data-bs-toggle="modal" data-bs-target="#deleteModal"
                    class="btn-classroom btn-delete px-3 btn-disabled"><img src="{{ asset('delete.svg') }}" width="15"
                        class="me-2" />Delete</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to delete?</h5>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-confirm" id="yes-btn" href="#">Yes</a>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('data-table');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    // Check if the clicked row is already selected
                    const isSelected = this.classList.contains('selected');

                    // Remove the selected class from all rows
                    rows.forEach(r => {
                        r.classList.remove('selected');
                    });

                    // If the clicked row wasn't already selected, select it
                    // If it was already selected, it remains deselected
                    if (!isSelected) {
                        this.classList.add('selected');
                    }

                    // Enable or disable the edit and delete buttons
                    const editButton = document.querySelector('.btn-edit');
                    const deleteButton = document.querySelector('.btn-delete');

                    // Change the href of the edit and delete buttons
                    const selectedRow = document.querySelector('.selected');
                    if (selectedRow) {
                        const id = selectedRow.querySelector('td:nth-child(2)').textContent;
                        editButton.href = `{{ route('students') }}/${id}/edit`;
                        document.querySelector('#yes-btn').href =
                            `{{ route('students') }}/${id}/delete`;
                    } else {
                        editButton.href = '#';
                        deleteButton.href = '#';
                    }

                    if (selectedRow) {
                        editButton.classList.remove('btn-disabled');
                        deleteButton.classList.remove('btn-disabled');
                    } else {
                        editButton.classList.add('btn-disabled');
                        deleteButton.classList.add('btn-disabled');
                    }
                });
            });
        });
    </script>
@endpush
