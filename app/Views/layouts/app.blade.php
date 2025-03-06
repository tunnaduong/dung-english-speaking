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
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-4 shadow-sm">
        <div class="container">
            <img src="{{ asset('logo.png') }}" alt="DungES Logo">
        </div>
    </nav>
    @yield('content')

    <script src="/js/bootstrap-5.3.3/bootstrap.min.js"></script>
    {{-- <script src="//cdn.tailwindcss.com"></script> --}}
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    @stack('scripts')
</body>

</html>
