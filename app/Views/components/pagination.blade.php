@php
    $queryParams = $_GET;
@endphp

@if ($last_page > 1)
    <nav class="d-flex justify-content-center">
        <ul class="pagination">

            {{-- Previous button --}}
            @php
                $queryParams['page'] = $current_page - 1;
                $prevUrl = '?' . http_build_query($queryParams);
            @endphp
            <li class="page-item {{ $current_page == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $current_page == 1 ? '#' : $prevUrl }}" tabindex="-1">Previous</a>
            </li>

            {{-- Page numbers --}}
            @for ($i = 1; $i <= $last_page; $i++)
                @php
                    $queryParams['page'] = $i;
                    $url = '?' . http_build_query($queryParams);
                @endphp
                <li class="page-item {{ $i == $current_page ? 'active' : '' }}">
                    <a class="page-link w-40" href="{{ $url }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Next button --}}
            @php
                $queryParams['page'] = $current_page + 1;
                $nextUrl = '?' . http_build_query($queryParams);
            @endphp
            <li class="page-item {{ $current_page == $last_page ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $current_page == $last_page ? '#' : $nextUrl }}">Next</a>
            </li>

        </ul>
    </nav>
@endif
