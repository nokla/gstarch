
@if ($paginator->hasPages())
<nav class="app-pagination">
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><-Précedant</a>
        </li>
        @else
        <li><a class="page-link"  href="{{ $paginator->previousPageUrl() }}" rel="prev"><-Précedant</a></li>
        @endif
        @foreach ($elements as $element)

        @if (is_string($element))
            <li class="page-item disabled"><span>{{ $element }}</span></li>
        @endif



        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach



    @if ($paginator->hasMorePages())
        <li class="page-item"><a  class="page-link" href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">Suivant-></a></li>
    @else
        <li  class="page-item disabled"> <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Suivant-></a></li>
    @endif
    </ul>
</nav>
@endif
