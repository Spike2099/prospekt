@php
    $path = './img/goods/'.$item['article'].'.jpg';
    $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';
@endphp
<a href="/{{$item['link']}}/{{$item['id']}}" class="card-body pb-0 position-relative">
    <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="d-flex align-items-center gap-1 z-3 position-absolute m-2">

        <meta itemprop="worstRating" content="1">
        <meta itemprop="ratingValue" content="4.9">
        <meta itemprop="bestRating" content="5">
    </div>
    @if(empty($item['description']))
        
    @endif
    <img
            itemprop="image"
            loading="lazy"
            src="{{$image}}"
            class="card-img-top rounded"
            alt="{{$item['article']}}, Проспект Партс, {{$item['article']}}"
    />
</a>