<div class="custom-pagination" id="ajax-pagination">
    <a class="page-nav ajax-pagination" href="{{ $products->previousPageUrl() ?? '#' }}" {{ $products->onFirstPage() ? 'disabled' : '' }}>
        <i class="fas fa-chevron-left"></i>
    </a>
    <div class="page-numbers">
        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <a class="page-number ajax-pagination {{ $products->currentPage() == $i ? 'active' : '' }}" href="{{ $products->url($i) }}">
                {{ $i }}
            </a>
        @endfor
    </div>
    <a class="page-nav ajax-pagination" href="{{ $products->nextPageUrl() ?? '#' }}" {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}>
        <i class="fas fa-chevron-right"></i>
    </a>
</div> 