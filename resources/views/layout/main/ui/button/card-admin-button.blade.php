<div>
    @if ($item['quantity'] == 0)
    <div
        id="preorder{{$item['id']}}"
        data-order="{{$item['id']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id'] ?? 'moysklad'}},1,{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"
        v-on:click="addToOrder('{{$item['id']}}')"
    >
        <button class="btn btn-secondary">
            <x-icon-add-card color="#fff" />
        </button>
    </div>
    @else
        <div 
            id="card{{$item['id']}}"
            data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id'] ?? 'moysklad'}},1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"
            v-on:click="addToCard('{{$item['id']}}')"
        >
            <button class="btn btn-dark">
                <x-icon-add-card color="#fff" />
            </button>
        </div>
    @endif 
</div>