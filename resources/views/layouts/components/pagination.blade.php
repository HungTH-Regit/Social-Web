<ul class="paginate">
    @if ($blogs->lastPage() > 1)
        <li class="arrow-paginate">
            <a href="{{ $blogs->previousPageUrl() }}" rel="prev">
                <i class="fa-solid fa-angle-left"></i>
            </a>
        </li>
        <li class="{{ ($blogs->currentPage() == 1) ? ' paginate-active' : '' }}">
            <a href="{{ $blogs->url($blogs->onFirstPage()) }}">1</a>
        </li>
        <?php
            $start = $blogs->currentPage() - 2;
            $end = $blogs->currentPage() + 2;
            if ($start < 1) {
                $start = 1;
                $end += 1;
            } 
            if ($end >= $blogs->lastPage()) {
                $end = $blogs->lastPage();
            }
        ?>
        @if ($blogs->currentPage() > 3)
            <li><span>...</span></li>
        @endif
        @for ($i = $start + 1; $i < $end; $i++)
                <li class="{{ ($blogs->currentPage() == $i) ? ' paginate-active' : '' }}">
                    <a href="{{ $blogs->url($i) }}">{{$i}}</a>
                </li>
        @endfor
        @if ($blogs->currentPage()+2 < $blogs->lastPage())
            <li><span>...</span></li>
        @endif
        <li class="{{ ($blogs->currentPage() == $blogs->lastPage()) ? ' paginate-active' : '' }}">
            <a href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a>
        </li>
        <li class="arrow-paginate">
            <a href="{{ $blogs->nextPageUrl() }}" rel="next">
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </li>
    @endif
</ul>
