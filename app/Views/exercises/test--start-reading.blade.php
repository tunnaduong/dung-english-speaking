@extends('layouts.home', ['active' => 2])

@section('title', 'Start Test | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 p-4">
        <div class="fs-5">
            <a class="text-decoration-none btn-back underline-hover" href="{{ previous('exercises/tests') }}">
                &lt; Reading</a>/{{ $test['name'] }}
        </div>
        <form action="{{ route('exercises/tests/' . $id . '/submit-reading') }}" method="POST" class="m-0">
            <div class="border-line p-2 rounded-4 mt-4 limit-height">
                <div class="fw-bold text-center fs-5">{{ $test['title'] }}</div>
                <div>{!! nl2br($test['content']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                <div>{!! nl2br($test['question']) !!}</div>
            </div>
            <div class="border-line p-2 rounded-4 mt-3 limit-height">
                @foreach (range(1, $test['number_of_answers']) as $answer)
                    <input type="text" class="form-control mt-2 mb-3" name="answers[{{ $answer }}]"
                        id="answer{{ $answer }}" placeholder="Answer {{ $answer }}">
                @endforeach
            </div>
            <input type="hidden" name="time_spent" id="timeSpent" value="00:00:00">
            <div class="d-flex justify-content-end mt-3 gap-4">
                <a href="{{ previous('exercises/tests') }}" class="btn-classroom">Cancel</a>
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
