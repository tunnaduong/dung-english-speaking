<!-- Sidebar -->
<nav class="col-auto col-lg-3 sidebar p-07 pe-0 offcanvas-lg offcanvas-start border-end border-1" id="offcanvasSidebar"
    tabindex="-1">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close text-reset" aria-label="Close Sidebar"></button>
    </div>
    <div class="offcanvas-body d-block">
        <div class="d-flex flex-row align-items-center mb-3">
            <img src="{{ asset('person.svg') }}" class="img-fluid mt-3 img-user">
            <h5 class="fw-bold mx-3 text-truncate" style="width: 200px; white-space: nowrap; overflow: hidden;">Hai My
            </h5>
        </div>
        <h5 class="my-4 sidebar-title">Menu</h5>
        <ul class="nav nav-pills flex-column">
            @php
                $request_uri = request()->uri();
            @endphp
            @if (isset($links))
                @foreach ($links as $label => $link)
                    <li class="nav-item">
                        <a class="nav-link {{ $link[0] == $request_uri ? 'active-link' : '' }}"
                            href="{{ $link[0] }}"><img src="{{ asset($link[1]) }}">{{ $label }}</a>
                    </li>
                @endforeach
            @else
                <li class="nav-item">
                    <a class="nav-link active-link" href="{{ env('APP_URL', '/') }}">Trang chủ</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
