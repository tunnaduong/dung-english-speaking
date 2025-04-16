@extends('layouts.home', ['active' => 2])

@section('title', 'Start Test | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ previous('exercises/tests') }}">
                &lt; Writing</a>/{{ $test['name'] }}
        </div>
        <form action="{{ route('exercises/tests/' . $id . '/submit-writing') }}" method="POST" class="m-0" id="writingForm">
            <div class="border-line p-2 rounded-4 mt-4 limit-height">
                <div class="fw-bold">Topic:</div>
                <div>{!! nl2br($test['topic']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3">
                <div>Type here</div>
                <textarea name="content" rows="15" id="writingContent" class="form-control border-0 shadow-none ps-0"></textarea>
                <div class="d-flex justify-content-between">
                    <div><span id="wordCount">0</span> words</div>
                    <div id="timer">Time left:
                        {{ $time_left !== null ? gmdate('i:s', $time_left) : 'No time limit' }}</div>
                </div>
            </div>
            <input type="hidden" name="time_spent" id="timeSpent" value="00:00">
            <input type="hidden" name="word_count" id="wordCountInput" value="0">
            <div class="d-flex justify-content-end mt-3 gap-4">
                <a href="{{ previous('exercises/tests') }}" class="btn-classroom">Cancel</a>
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
            document.getElementById('wordCountInput').value = words; // Cập nhật giá trị ẩn
        });
    </script>
    <script>
        const timeLeftFromPHP = {{ $time_left !== null ? $time_left : 'null' }};
        let countdownInterval;

        function formatTime(seconds) {
            const minutes = String(Math.floor(seconds / 60)).padStart(2, '0');
            const secs = String(seconds % 60).padStart(2, '0');
            return `${minutes}:${secs}`;
        }

        function startCountdown() {
            if (timeLeftFromPHP === null) return; // không có giới hạn thời gian

            let timeLeft = timeLeftFromPHP;

            countdownInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    document.getElementById("timer").innerText = "Time left: 00:00";
                    autoSubmit();
                } else {
                    document.getElementById("timer").innerText = `Time left: ${formatTime(timeLeft)}`;
                    document.getElementById("timeSpent").value = formatTime({{ $max_time * 60 }} - timeLeft);
                    timeLeft--;
                }
            }, 1000);
        }

        function autoSubmit() {
            alert("⏱ Time is up! Auto submitting test...");
            document.getElementById("writingForm").submit();
        }

        startCountdown();
    </script>
@endpush
