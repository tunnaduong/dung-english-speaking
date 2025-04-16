@extends('layouts.home', ['active' => 2])

@section('title', 'Start Test | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ previous('exercises/tests') }}">
                &lt; Listening</a>/{{ $test['name'] }}
        </div>
        <div class="mt-4">
            <audio controls class="w-50">
                <source src="{{ route('mp3/' . $test['audio_url']) }}" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <form action="{{ route('exercises/tests/' . $id . '/submit-listening') }}" method="POST" class="m-0"
            id="listeningForm">
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                <div class="fw-bold">{!! nl2br($test['question']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-4 limit-height">
                <div class="fw-bold text-center fs-5">{{ $test['title'] }}</div>
                <div>{!! nl2br($test['content']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                @foreach (range(1, $test['number_of_answers']) as $answer)
                    <input type="text" class="form-control mt-2 mb-3" name="answers[{{ $answer }}]"
                        id="answer{{ $answer }}" placeholder="Answer {{ $answer }}">
                @endforeach
            </div>
            <input type="hidden" name="time_spent" id="timeSpent" value="00:00:00">
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
            document.getElementById("listeningForm").submit();
        }
        // count up timer, change the hidden input value every second
        let timeSpent = 0; // seconds
        const timeSpentInput = document.getElementById('timeSpent');
        const timerInterval = setInterval(() => {
            timeSpent++;
            const hours = Math.floor(timeSpent / 3600);
            const minutes = Math.floor((timeSpent % 3600) / 60);
            const seconds = timeSpent % 60;
            timeSpentInput.value =
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }, 1000);
    </script>
@endpush
