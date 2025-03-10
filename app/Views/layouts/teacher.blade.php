<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/icons/app-32.png">
    <title>@yield('title')</title>

    @stack('meta')
    <link href="/css/bootstrap-5.3.3/bootstrap.min.css" rel="stylesheet">
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
            <div class="row">
                @include('components.sidebar', [
                    'title' => 'Menu',
                    'links' => [
                        'My Profile' => ['/profile', 'face.svg'],
                        'Classrooms' => ['/classrooms', 'school.svg'],
                        'Courses' => ['/courses', 'library_books.svg'],
                        'Students' => ['/students', 'person_outline.svg'],
                        'Exercises' => ['/exercises', 'menu_book.svg'],
                        'Correction' => ['/correction', 'playlist_add_check.svg'],
                        'Log Out' => ['/logout', 'logout.svg'],
                    ],
                    'active' => $active ?? null,
                ])
                <main class="col px-md-4">
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
