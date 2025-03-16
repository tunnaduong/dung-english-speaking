@extends('layouts.teacher', ['active' => 3])

@section('title', 'Students | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill text-white">
                <h2 class="fw-bold zoom">Hi {{ getLastWord(session('user')['name']) }}, Good Afternoon!</h2>
                <p class="m-0 zoom">&nbsp;</p>
            </div>
            <div class="w-200">
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 my-4 bg-white rounded-4 p-4 exercise-menu">
        <div class="mb-4">
            <h4 class="fw-bold">Students</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="d-flex">
            <form action="" class="position-relative m-0">
                <img src="{{ asset('search.svg') }}" class="search-icon">
                <input type="text" placeholder="Searching" class="search-input form-control form-control-lg"
                    id="search" name="search" value="{{ $_GET['search'] ?? 'Hai My' }}">
            </form>
        </div>
        <div class="table-responsive my-3">
            <table class="table table-custom table-big table-sticky table-horizontal m-0">
                <thead class="overflow-hidden">
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Class</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="{{ route('students/1/profile') }}" class="text-black">Nguyen Thi Hai My</a></td>
                        <td>0987654321</td>
                        <td>myhainguyen02@gmail.com</td>
                        <td>Pre IELTS 01</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
