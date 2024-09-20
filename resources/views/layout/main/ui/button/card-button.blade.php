@if($item['quantity'] == 0)
    <div onclick="isNotSignUp()" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
        <x-icon-add-card size="25px" color="#fff" />
    </div>
@else
{{-- {{$item['volume']}} --}}
<!-- ['stock' => $item['productFolder']] мб ссылка -->
    @if ($item['productFolder']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175')
        <div
            id="card{{$item['id']}}"
            data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},moysklad,1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"
            v-on:click="addToCard('{{$item['id']}}')"
            class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2"
        >
            <x-icon-add-card size="25px" color="#fff" />
        </div>
    @else
        <div onclick="partnerStockEvent()" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
            <x-icon-add-card size="25px" />
        </div>
    @endif

@endif