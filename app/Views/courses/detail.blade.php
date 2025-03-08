@extends('layouts.home', ['active' => 1])

@section('title', 'Courses | DungES')

@section('content')
    <div class="w-100 my-4 bg-white rounded-4 overflow-hidden">
        <div class="bg-gray p-4">
            <h4 class="fw-bold text-uppercase">Pre IELTS</h4>
            <div class="line-bottom"></div>
            <div class="mt-2 fs-14">Giáo viên: Tiến Dũng</div>
        </div>
        <div class="p-4">
            <h5 class="fw-bold mb-3">Bạn sẽ đạt được gì sau khóa học</h5>
            <div class="rounded-4 border-line px-2 pt-3">
                <div class="container">
                    <div class="row mb-3 g-3">
                        <div class="col-12 col-md-6 d-flex">
                            <img src="{{ asset('check 1.svg') }}" class="me-2 align-self-start">
                            <div class="fs-14">
                                Định hướng lại cách học tiếng Anh đúng, từ đó trở nên yêu thích việc
                                học hơn.</div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <img src="{{ asset('check 1.svg') }}" class="me-2 align-self-start">
                            <div class="fs-14">Hiểu được cách học từ vựng/ ngữ pháp hiệu quả.</div>
                        </div>
                    </div>
                    <div class="row mb-3 g-3">
                        <div class="col-12 col-md-6 d-flex">
                            <img src="{{ asset('check 1.svg') }}" class="me-2 align-self-start">
                            <div class="fs-14">Có khả năng nối từ để viết thành câu hoàn chỉnh</div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <img src="{{ asset('check 1.svg') }}" class="me-2 align-self-start">
                            <div class="fs-14">Hiểu được bản chất của tiếng Anh và sự khác biệt giữa tiếng Anh và tiếng
                                Việt.</div>
                        </div>
                    </div>
                    <div class="row mb-3 g-3">
                        <div class="col-12 col-md-6 d-flex">
                            <img src="{{ asset('check 1.svg') }}" class="me-2 align-self-start">
                            <div class="fs-14">Tích luỹ những từ vựng cơ bản nhất cho từng chủ đề áp dụng được cho kỹ năng
                                Nghe - Nói -
                                Đọc - Viết</div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="fw-bold mt-5">Nội dung chương trình học 9 tuần</h5>
            <div class="fs-14 mb-3">27 Buổi</div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($courseContent as $sessionTitle => $session)
                    <div class="accordion-item rounded-3 mb-2 border-line overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button border-bottom collapsed fw-semi fs-14" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loop->index }}"
                                aria-expanded="false" aria-controls="flush-collapse{{ $loop->index }}">
                                {{ $sessionTitle }}
                                <span class="ms-auto fw-normal flex-shrink-0">{{ $session['duration'] }}</span>
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $loop->index }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body fs-14">
                                <ul class="m-0">
                                    @foreach ($session['details'] as $detail)
                                        <li>{{ $detail }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-more mt-2">Xem thêm 20 buổi</button>
        </div>
    </div>
@endsection
