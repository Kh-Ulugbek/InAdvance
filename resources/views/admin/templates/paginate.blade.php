<div class="pagination">
    @if(!empty($items->appends(request()->except(['page', '_token']))->previousPageUrl()))
        <a href="{{ $items->previousPageUrl() }}">&laquo;</a>
    @endif
    @if($items->currentPage() > 3)
        <a href="{{ $items->url(1) }}">1</a>
    @endif
    @if($items->currentPage() > 4)
        <a>...</a>
    @endif
    @if($items->currentPage() > 2)
        <a href="{{ $items->url($items->currentPage() - 2) }}">{{ $items->currentPage() - 2 }}</a>
    @endif
    @if(!empty($items->previousPageUrl()))
        <a href="{{ $items->previousPageUrl() }}">{{ $items->currentPage() - 1 }}</a>
    @endif
    <a href="#" class="active">{{ $items->currentPage() }}</a>
    @if($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}">{{ $items->currentPage() + 1 }}</a>
    @endif
    @if(($items->lastPage() - $items->currentPage()) > 2)
        <a href="{{ $items->url($items->currentPage() + 2) }}">{{ $items->currentPage() + 2 }}</a>
    @endif
    @if(($items->lastPage() - $items->currentPage()) > 3)
        <a>...</a>
    @endif
    @if(!($items->lastPage() == $items->currentPage()) and ($items->lastPage() - $items->currentPage()) > 1)
        <a href="{{ $items->url($items->lastPage()) }}">{{ $items->lastPage() }}</a>
    @endif
    @if($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}">&raquo;</a>
    @endif
    <form method="get" action="{{ route(Route::currentRouteName()) }}">
        <input data-mask="00000" value="{{ $items->currentPage() }}" class="pagination pagination__pageInput" name="page" type="text">
        <select class="pagination pagination__perPage" name="per_page">
            <option @if(!empty(request()->get('per_page')) and request()->get('per_page') == 10) selected @endif>10</option>
            <option @if(!empty(request()->get('per_page')) and request()->get('per_page') == 50) selected @endif>50</option>
            <option @if(!empty(request()->get('per_page')) and request()->get('per_page') == 100) selected @endif>100</option>
        </select>
        <button class="pagination pagination__button" type="submit">Впред</button>
    </form>
</div>

