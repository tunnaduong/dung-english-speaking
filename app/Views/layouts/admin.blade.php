<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/icons/app-32.png">
    <title>@yield('title')</title>

    @stack('meta')
    <link href="/css/bootstrap-5.3.3/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <link href="/css/fonts.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-4 shadow-sm position-relative z-2">
        <div class="container">
            <img src="{{ asset('logo.png') }}" alt="DungES Logo">
            <!-- Sidebar Toggle Button (Visible on Mobile) -->
            <button class="btn btn-danger d-lg-none bg-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar">
                ☰ Menu
            </button>
        </div>
    </nav>

    <div class="bg-color">
        <div class="left-white"></div>
        <div class="container">
            <div class="row flex-nowrap">
                @include('components.sidebar', [
                    'title' => 'Menu',
                    'links' => [
                        'Classrooms' => ['/classrooms', 'school.svg'],
                        'Personnel' => ['/personnel', 'person_pin.svg'],
                        'Students' => ['/students', 'person_outline.svg'],
                        'Courses' => ['/courses', 'library_books.svg'],
                        'School Shift' => ['/school-shift', 'calendar_month.svg'],
                        'Account' => ['/account', 'account_circle.svg'],
                        'Log Out' => ['/logout', 'logout.svg'],
                    ],
                    'active' => $active ?? null,
                ])
                <main class="col px-md-4 min-w-0">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap-5.3.3/bootstrap.min.js"></script>
    {{-- <script src="//cdn.tailwindcss.com"></script> --}}
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        document.addEventListener("DOMContentLoaded", function() {
            let sidebar = document.getElementById("offcanvasSidebar");
            let close = sidebar.querySelector(`[aria-label="Close Sidebar"]`); // Select all links inside sidebar

            close.addEventListener("click", function() {
                let bsOffcanvas = bootstrap.Offcanvas.getInstance(sidebar);
                if (bsOffcanvas) {
                    bsOffcanvas.hide(); // Close the sidebar
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
