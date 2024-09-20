<div class="d-flex align-items-center justify-content-between">
    <div>
        @if ($item['productFolder']['id'] === 'turkishStock')
            @if ($item['quantity'] == 0)
                <x-badge color="danger" text="Нет в наличии" /> 
            @else
                <x-badge color="34617" text="Склад Турция {{$item['quantity']}}" />  
            @endif                         
        @else
            @if ($item['quantity'] == 0)
                <x-badge color="danger" text="Нет в наличии" />
            @else
                <x-badge color="34617" text="В наличии {{$item['quantity']}}" />
            @endif
        @endif
    </div>
    <h5 class="m-0">{!! $currency::summa($item['salePrices'][0]['value']) !!}</h5> 
</div>
<hr style="color: #ddd" />