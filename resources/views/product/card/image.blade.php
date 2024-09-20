@php
    $path = './img/goods/'.$item['article'].'.jpg';
    $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';
@endphp
<a href="/product/{{$item['id']}}" class="card-body pb-0 position-relative">
    <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="d-flex align-items-center gap-1 z-3 position-absolute m-2">
        {{-- <x-icon-favorite color="#b02a37" />
        <small>{{rand(4, 5)}}.{{rand(0, 9)}} рейтинг</small>  --}}
        @include('layout.main.ui.badge.stock', ['stock' => 'sklad_2'])

        <meta itemprop="worstRating" content="1">
        <meta itemprop="ratingValue" content="4.9">
        <meta itemprop="bestRating" content="5">
    </div>
    <img
            itemprop="image"
            loading="lazy"
            src="{{$image}}"
            class="card-img-top rounded"
            alt="{{$item['article']}}, Проспект Партс"
    />
</a>
{{-- {{$images::src($item['id'])}} --}}