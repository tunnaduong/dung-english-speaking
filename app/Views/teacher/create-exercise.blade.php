@extends('layouts.teacher', ['active' => 4])

@section('title', 'Create Exercise | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4 border-line">
        <div>
            <h4 class="fw-bold"><a href="{{ route('exercises') }}" class="back-link">
                    Exercises</a>/Create</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="border-line rounded-4 p-3 mt-3 d-flex align-items-center gap-3">
            <img src="{{ asset('menu_book_large.svg') }}">
            <div>
                <h5 class="fw-bold mb-1">Reading document</h5>
                <div class="fw-semi text-gray">3.0-4.0</div>
                <div class="fw-semi text-gray">Reading</div>
            </div>
        </div>
        <form action="" method="POST">
            <div>
                <label for="deBai" class="form-label fw-bold mt-3">Add topic</label>
                <textarea name="deBai" id="deBai" class="form-control" rows="10"></textarea>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        CKEDITOR.replace('deBai');
    </script>
@endpush

@push('styles')
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
@endpush
