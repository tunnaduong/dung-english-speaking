@extends('layouts.home', ['active' => 1])

@section('title', 'Courses | DungES')

@section('content')
    <div class="w-100 mt-4 bg-primary home-hero rounded-4 d-flex align-items-center justify-content-center px-3">
        <div class="hero-content d-flex align-items-center justify-content-between">
            <div class="flex-fill">
                <h2 class="text-white fw-bold zoom">Dũng English Speaking</h2>
                <p>&nbsp;</p>
            </div>
            <div>
                <img src="{{ asset('hero.png') }}" class="hero-img img-fluid">
            </div>
        </div>
    </div>
    <div class="w-100 mt-4 bg-white rounded-4 p-4">
        <div>
            <h4 class="fw-bold">My Courses</h4>
            <div class="line-bottom"></div>
        </div>
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6 col-12">
                    <div class="rounded-4 border-line mt-3">
                        <div class="p-3 px-4">
                            <div class="fw-bold fs-5 text-decoration-none text-black">{{ $course['class_name'] }} -
                                {{ $course['NoL'] }}
                                lectures</div>
                            <div class="progress-text">25%</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="p-3 px-4 d-flex justify-content-center align-items-center">
                            <a href="{{ route('courses/' . $course['c_id']) }}" class="btn-classroom">Curriculum</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container px-0 my-4">
        <div class="row gy-4">
            <div class="col-12 col-md-6">
                <div class="calendar-container p-4">
                    <div class="calendar-header">
                        <div class="fs-5">My Progress</div>
                        <select id="month-year-select" class="form-select border-0 form-select-sm w-auto text-muted fs-6"
                            onchange="updateCalendar()"></select>
                    </div>

                    <div class="row text-center g-0">
                        <div class="col">Mon</div>
                        <div class="col">Tue</div>
                        <div class="col">Wed</div>
                        <div class="col">Thu</div>
                        <div class="col">Fri</div>
                        <div class="col">Sat</div>
                        <div class="col">Sun</div>
                    </div>

                    <div id="calendar-body"></div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-3 bg-white rounded-4">
                    <div class="fs-5 fw-bold mb-3">Note</div>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center">
                            <div class="day-blue"></div>
                            <span class="ms-2 fw-bold">Pre02 - Grammar</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="day-green"></div>
                            <span class="ms-2 fw-bold">Pre02 - Vocabulary</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentDate = new Date();
        let highlightedDays = {
            "2025-2": {
                6: "#00966d", // Green
                8: "#2f80ed", // Blue
            },
            "2025-3": {
                4: "#2f80ed",
                6: "#00966d",
                8: "#2f80ed",
                11: "#2f80ed",
                13: "#00966d",
                15: "#2f80ed",
                18: "#2f80ed",
                20: "#00966d",
                22: "#2f80ed",
                25: "#2f80ed",
                27: "#00966d",
            },
            "2025-4": {
                3: "#00966d",
                10: "#00966d",
                17: "#00966d",
                24: "#00966d",
                1: "#2f80ed",
                8: "#2f80ed",
                15: "#2f80ed",
                22: "#2f80ed",
                29: "#2f80ed",
                5: "#2f80ed",
                12: "#2f80ed",
                19: "#2f80ed",
                26: "#2f80ed",
            }
        };

        function generateCalendar() {
            const calendarBody = document.getElementById("calendar-body");
            const monthYearSelect = document.getElementById("month-year-select");

            let year = currentDate.getFullYear();
            let month = currentDate.getMonth();

            // Populate the dropdown
            monthYearSelect.innerHTML = "";
            for (let y = year - 5; y <= year + 5; y++) {
                for (let m = 0; m < 12; m++) {
                    let option = document.createElement("option");
                    option.value = `${y}-${m + 1}`;
                    option.textContent = new Date(y, m).toLocaleString("default", {
                        month: "long",
                        year: "numeric"
                    }).toUpperCase();
                    if (y === year && m === month) option.selected = true;
                    monthYearSelect.appendChild(option);
                }
            }

            let firstDay = new Date(year, month, 1).getDay();
            let daysInMonth = new Date(year, month + 1, 0).getDate();

            // Adjust for Monday as the first day
            firstDay = (firstDay === 0) ? 6 : firstDay - 1;

            let calendarHTML = "";
            let dayCounter = 1;

            let monthKey = `${year}-${month + 1}`;
            let daysToHighlight = highlightedDays[monthKey] || {};

            for (let row = 0; row < 6; row++) {
                calendarHTML += '<div class="row text-center mt-1 g-0 flex-nowrap">';
                for (let col = 0; col < 7; col++) {
                    if ((row === 0 && col < firstDay) || dayCounter > daysInMonth) {
                        calendarHTML += '<div class="col d-flex justify-content-center"></div>';
                    } else {
                        let dayStyle = "";
                        let today = new Date();

                        // Highlight today's date
                        if (dayCounter === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                            dayStyle = "background-color: #ff3b30; color: white;";
                        }

                        // Highlight dynamically fetched days with different colors
                        if (daysToHighlight[dayCounter]) {
                            dayStyle = `background-color: ${daysToHighlight[dayCounter]}; color: white;`;
                        }

                        if (daysToHighlight[dayCounter] && (dayCounter === today.getDate() && month === today.getMonth() &&
                                year === today.getFullYear())) {
                            dayStyle += `border: 4px solid #ff3b30;`;
                        }

                        calendarHTML +=
                            `<div class="col d-flex justify-content-center">
                    <div class="calendar-day" style="${dayStyle}">${dayCounter}</div>
                </div>`;
                        dayCounter++;
                    }
                }
                calendarHTML += "</div>";
            }

            calendarBody.innerHTML = calendarHTML;
        }

        function updateCalendar() {
            const monthYearSelect = document.getElementById("month-year-select");
            let [year, month] = monthYearSelect.value.split("-");
            year = parseInt(year);
            month = parseInt(month) - 1;

            currentDate.setFullYear(year);
            currentDate.setMonth(month);
            generateCalendar();
        }

        generateCalendar();
    </script>
@endpush
