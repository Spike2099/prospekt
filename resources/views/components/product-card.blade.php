@php
    $code = isset($vendorcode) ? $vendorcode : 'Нет данных';
    $href = isset($href) ? $href : 0;
@endphp
<tr>
    <td>
        <div class="ms-2">
            {{$id}}
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center gap-2">
            <img src="{{$images::src($href)}}" alt="{{$name}}" class="rounded image-product border border-muted" />
            <small>
                <a href="/dashboard/product/details/{{$href}}" class="name fw-bold text-decoration-none text-dark">
                    {{$name}}
                </a>
            </small>
        </div>
    </td>
    <td>
        <a href="/dashboard/product/details/{{$href}}" class="text-danger text-decoration-none">
            {{$code}}
        </a>
    </td>
    <td>
        <small>
            <strong>
                {!!$currency::summa($price)!!}
                {{-- @php echo number_format(($price) / 100, 2, '.', ' ') @endphp ₽ --}}
            </strong>
        </small>
    </td>
    <td>
        <div class="d-flex gap-2">
            {{-- @role('admin')
                ({{$availability}})
            @endrole --}}
            
            @if($availability === '0' || $availability < 0)
                <x-badge color="danger" text="Нет в наличии" />
            @else
                <x-badge color="34617" text="В наличии {{$availability}} шт." />
            @endif            
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center gap-2">
            <img src="/img/guayaquillib/mercedes-benz.png" alt="MERCEDES-BENZ" style="width: 30px" />
            <small style="font-size: 10px">MERCEDES-BENZ</small>
        </div>
    </td>
    <td>
        @if($availability === '0' || $availability < 0)
        <div
            id="preorder{{$href}}"
            data-order="{{$href}},{{$code}},{{$name}},1,{{$price}}"
            v-on:click="addToOrder('{{$href}}')"
        >  
            <button type="button" class="btn btn-sm btn-secondary px-4 d-flex align-items-center gap-2 justify-content-center">
                <x-icon-add-card color="#fff" />
                В корзину
            </button>         
        </div>
        @else
        <div
            id="card{{$href}}" 
            data-card="{{$href}},{{$code}},{{$name}},{{$category}},1,{{$price}},{{$price}},{{$images::src($href)}}"
            v-on:click="addToCard('{{$href}}')"    
        >
{{--data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id'] ?? 'moysklad'}},1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"--}}
            <button type="button" class="btn btn-sm btn-dark px-4 d-flex align-items-center gap-2 justify-content-center">
                <x-icon-add-card color="#fff" />
                В корзину
            </button>     
        </div>        
        @endif
    </td>
</tr>