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
                <div class="position-relative">
                    <input class="fw-bold fs-5 mb-1 form-control px-2 py-0 w-200" value="Reading Part 1"></input>
                    <img src="{{ asset('edit2.svg') }}" class="position-absolute edit-icon">
                </div>
                <div class="fw-semi text-gray">
                    <label for="level" style="width: 50px">Level</label>
                    <select name="level" id="level" class="rounded-1">
                        <option value="3-4">3.0-4.0</option>
                    </select>
                </div>
                <div class="fw-semi text-gray">
                    <label for="skill" style="width: 50px">Skill</label>
                    <select name="skill" id="skill" class="rounded-1">
                        <option value="reading">Reading</option>
                    </select>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            <div>
                <label for="deBai" class="form-label fw-bold mt-3">Add topic</label>
                <textarea name="deBai" id="deBai" class="form-control" rows="10">
                    <strong>THE IMPORTANCE OF CHILDREN'S PLAY</strong>
                    <p>Brick by brick, six-year-old Alice is building a magical kingdom. Imagining fairy-tale turrets and fire-breathing dragons, wicked witches and gallant heroes, she's creating an enchanting world. Although she isn't aware of it, this fantasy is helping her take her first steps towards her capacity for creativity and so it will have important repercussions in her adult life.Minutes later, Alice has abandoned the kingdom in favour of playing schools with her younger brother. When she bosses him around as his 'teacher', she's practising how to regulate her emotions through pretence. Later on, when they tire of this and settle down with a board game, she's learning about the need to</p>
                </textarea>
            </div>
            <div>
                <label for="cauHoi" class="form-label fw-bold mt-3">Add question</label>
                <textarea name="cauHoi" id="cauHoi" class="form-control" rows="10">
                    <strong>Questions 1-8 Complete the notes below.<br>
                        Choose ONE WORD ONLY from the passage for each answer.<br>
                        Write your answers in boxes 1-8 on your answer sheet.</strong>
                        <p>Children's play<br>
                            Uses of children's play<br>
                            building a 'magical kingdom' may help develop 1.......<br>
                            board games involve 2 ....... and turn-taking<br>
                            Recent changes affecting children's play<br>
                            populations of 3....... have grown<br>
                            opportunities for free play are limited due to<br>
                            - fear of 4 .......<br>
                            - fear of 5 .......</p>
                </textarea>
            </div>
            <div>
                <label for="cauHoi" class="form-label fw-bold mt-3">Add answers</label>
                <div class="border-line rounded-4 px-3 py-2">
                    <div>1.</div>
                    <div>2.</div>
                    <a href="#" class="text-decoration-none text-black" style="margin-left: -5px">
                        <img src="{{ asset('plus.svg') }}" class="add-icon"> Add another answer
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3 gap-4">
                <a href="{{ route('exercises') }}" class="btn-classroom">Cancel</a>
                <button class="btn-classroom" type="submit">Create</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        CKEDITOR.replace('deBai');
        CKEDITOR.replace('cauHoi');
    </script>
@endpush

@push('styles')
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
@endpush
