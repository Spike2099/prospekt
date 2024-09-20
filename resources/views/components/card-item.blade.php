@php
    $isImage = $image === '' ? '/img/no_photo.jpg' : $image;
    $ifBig = $percent > 94 ? 'btn-success' : 'btn-danger';
    $isTotal = $percent >= 100 ? 'bg-success' : 'text-dark bg-warning';
    $price = number_format($price, 2, '.', ' ').' ₽';
@endphp
<li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
    <small class="d-flex align-items-center gap-3" style="width: 250px">
        <img src="{{$isImage}}" class="rounded" style="width: 50px" alt="" />
        <a href="/search/index/{{$id}}" class="fw-bold text-dark text-decoration-none">
            {{$articul}}
        </a>
        {{$name}} 
    </small>

    <div class="position-relative">
        {{$price}}
        <span class="badge rounded-pill text-dark bg-light">за 1 шт.</span>
    </div>          

    
    <x-badge color="34617" text="{{$price}}" />

    <div class="input-group" style="width: 140px">
        <button class="btn btn-sm material-symbols-outlined pe-0">add</button>
        <input type="number" min="1" class="form-control form-control-sm border-0 text-center" value="{{$count}}" />
        <button class="btn btn-sm material-symbols-outlined ps-0">remove</button>
    </div>

    <div class="btn-group">
        <a href="/delete/{{$id}}" class="btn text-danger rounded material-symbols-outlined">delete</a>
    </div>
</li>