@extends('layouts.teacher', ['active' => 5])

@section('title', 'Homeworks | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line exercise-menu">
        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">
                <a href="{{ route('correction') }}" class="back-link">
                    Correction</a>/Homeworks
            </h4>
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg"
                    id="search" name="search" value="{{ $_GET['search'] }}">
            </form>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <h4 class="fw-bold m-0 flex-shrink-0">{{ $classroom['class_name'] }} - Homeworks</h4>
        </div>
        <div>
            <div>
                <h4 class="fw-bold">Homeworks</h4>
                <div class="line-bottom"></div>
            </div>
            {{-- Table --}}
            <div class="table-responsive my-3">
                <table class="table table-custom table-big table-sticky">
                    <thead class="overflow-hidden">
                        <tr>
                            <th>No.</th>
                            <th>ID Exercise</th>
                            <th>Exercise Name</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exercises as $exercise)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $exercise['id'] }}</td>
                                <td>{{ $exercise['name'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($exercise['created_at'])) }}</td>
                                <td><a href="{{ route("correction/$id/homeworks/" . $exercise['id']) }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
