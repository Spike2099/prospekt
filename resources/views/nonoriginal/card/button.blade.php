@if($item['quantity'] == 0)
    <div onclick="isNotSignUp()"
         class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
        <x-icon-add-card size="25px" color="#fff"/>
    </div>
@else
    {{--    <div onclick="partnerStockEvent()"--}}
    {{--         class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">--}}
    {{--        <x-icon-add-card size="25px"/>--}}
    {{--    </div>--}}
{{-- костыль на 100--}}
    <div
            id="card{{$item['id']}}"
            data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},1,{{$item['price'] * 100}},{{$item['price'] * 100}},{{$images::src($item['article'])}}"
            v-on:click="addToCard('{{$item['id']}}')"
            class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2"
    >
        <x-icon-add-card size="25px" color="#fff"/>
    </div>
@endif