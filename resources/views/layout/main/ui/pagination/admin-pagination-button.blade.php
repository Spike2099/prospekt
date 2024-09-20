<nav>
    <ul class="pagination m-0">
        @if($offset != 0)
        <li class="page-item">
            <a class="page-link text-muted" href="{{$offset-$limit}}">&larr; Предыдущие</a>
        </li>
        @endif

        @if($product['meta']['size']-$offset > $limit)
        <li class="page-item">
            <a class="page-link text-muted" href="{{$offset === 0 ? $name.'/'.($limit+$offset).'/'.$offset : $limit+$offset}}">Далее &rarr;</a>
        </li>
        @endif
    </ul>
</nav>