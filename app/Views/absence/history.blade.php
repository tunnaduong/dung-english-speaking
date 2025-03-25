@extends('layouts.home', ['active' => 3])

@section('title', 'Absence History | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill text-white">
                <h2 class="fw-bold zoom">Hi {{ getLastWord(session('user')['name']) }}, Good Afternoon!</h2>
                <p class="m-0 zoom">You've learned 70% of your goal this week!<br>
                    Keep it up and improve your progress.</p>
            </div>
            <div class="w-200">
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4 exercise-menu">
        <div>
            <h4 class="fw-bold"><a href="{{ route('absence') }}" class="back-link">Absence</a>/History</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-big">
                <thead class="overflow-hidden">
                    <tr>
                        <th>Date</th>
                        <th>Shift</th>
                        <th>Reason of absence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historyData as $history)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($history['date'])) }}</td>
                            <td>Ca 1</td>
                            <td>{{ $history['reason'] }}</td>
                        </tr>
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
@endsection
