@php
    $path = './img/goods/'.$item['article'].'.jpg'; // {{$images::src($item['id'])}}
    $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';
@endphp
<a href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}" class="card-body pb-0 position-relative">
    <div class="d-flex align-items-center gap-1 z-3 position-absolute rounded-2 m-2">
        {{-- <x-icon-favorite color="#b02a37" />
        <small>{{rand(4, 5)}}.0 рейтинг</small> --}}
        @include('layout.main.ui.badge.stock', ['stock' => $item['productFolder']['id']])
    </div>
    <img 
        src="{{$image}}" 
        class="card-img-top rounded" 
        alt="{{$item['name']}}" 
    />
</a>