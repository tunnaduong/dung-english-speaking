@extends('layouts.home', ['active' => 2])

@section('title', 'Start Homework | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ previous('exercises/homeworks') }}">
                &lt; Writing</a>/{{ $homework['name'] }}
        </div>
        <form action="{{ route('exercises/homeworks/' . $id . '/submit-writing') }}" method="POST" class="m-0"
            id="writingForm">
            <div class="border-line p-2 rounded-4 mt-4 limit-height">
                <div class="fw-bold">Topic:</div>
                <div>{!! $homework['topic'] !!}</div>
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
        </form>
        <div class="d-flex justify-content-end mt-3 gap-4">
            <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
            <button class="btn-classroom" data-bs-toggle="modal" data-bs-target="#saveConfirmModal">Submit</button>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="cancelModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to cancel?</h5>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-confirm" href="{{ previous('exercises/homeworks') }}">Yes</a>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="saveConfirmModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="fw-semi mb-4">Do you want to submit?</h5>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-confirm" onclick="submitForm()">Yes</button>
                        <button type="button" class="btn btn-confirm" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById("writingForm").submit();
        }
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
            document.getElementById("timeSpent").value = formatTime({{ $max_time * 60 }});
            document.getElementById("writingForm").submit();
        }

        startCountdown();
    </script>
@endpush
