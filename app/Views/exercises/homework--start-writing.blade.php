@extends('layouts.home', ['active' => 2])

@section('title', 'Start Homework | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ route('exercises/homeworks') }}">
                &lt; Writing</a>/Homework 3
        </div>
        <form action="" method="POST" class="m-0">
            <div class="border-line p-2 rounded-4 mt-4">
                <div class="fw-bold">Topic:</div>
                <div>{{ $homework['topic'] }}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3">
                <div>Type here</div>
                <textarea name="comment" rows="15" id="writingContent" class="form-control border-0 shadow-none ps-0"></textarea>
                <div><span id="wordCount">0</span> words</div>
            </div>
            <div class="d-flex justify-content-end mt-3 gap-4">
                <a href="{{ route('exercises/homeworks') }}" class="btn-classroom">Cancel</a>
                <button class="btn-classroom" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const textarea = document.getElementById('writingContent');
        const wordCountDisplay = document.getElementById('wordCount');

        textarea.addEventListener('input', () => {
            const text = textarea.value.trim();

            // Đếm số từ (loại bỏ dấu cách thừa)
            const words = text === '' ? 0 : text.split(/\s+/).length;

            wordCountDisplay.textContent = words;
        });
    </script>
@endpush
