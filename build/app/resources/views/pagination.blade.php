@if ($paginator->hasPages())
<nav class="pagination is-centered" role="navigation" aria-label="pagination">
    @if ($paginator->onFirstPage())
        <a class="pagination-previous" disabled>&lsaquo;&lsaquo;</a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous">&lsaquo;&lsaquo;</a>
    @endif
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">&rsaquo;&rsaquo;</a>
    @else
        <a class="pagination-next" disabled>&rsaquo;&rsaquo;</a>
    @endif
    <ul class="pagination-list">
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li><span class="pagination-ellipsis">&hellip;</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="pagination-link is-current"><span>{{ $page }}</span></li>
                @else
                    <li class="pagination-link"><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    </ul>
    @endforeach
</nav>
@endif
