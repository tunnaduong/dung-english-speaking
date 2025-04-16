@extends('layouts.home', ['active' => 2])

@section('title', 'Start Homework | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ previous('exercises/homeworks') }}">
                &lt; Listening</a>/{{ $homework['name'] }}
        </div>
        <div class="mt-4">
            <audio controls class="w-50">
                <source src="{{ route('mp3/' . $homework['audio_url']) }}" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
        </div>
        <form action="{{ route('exercises/homeworks/' . $id . '/submit-listening') }}" method="POST" class="m-0">
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                <div class="fw-bold">{!! nl2br($homework['question']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-4 limit-height">
                <div class="fw-bold text-center fs-5">{{ $homework['title'] }}</div>
                <div>{!! nl2br($homework['content']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                @foreach (range(1, $homework['number_of_answers']) as $answer)
                    <input type="text" class="form-control mt-2 mb-3" name="answers[{{ $answer }}]"
                        id="answer{{ $answer }}" placeholder="Answer {{ $answer }}">
                @endforeach
            </div>
            <input type="hidden" name="time_spent" id="timeSpent" value="00:00:00">
            <div class="d-flex justify-content-end mt-3 gap-4">
                <a href="{{ previous('exercises/homeworks') }}" class="btn-classroom">Cancel</a>
                <button class="btn-classroom" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
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
