<div class="d-flex align-items-center justify-content-between gap-2">
    <div>
        @if($item['quantity'] > 0)
            <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">
                <link itemprop="availability" href="https://schema.org/InStock">Склад Турция{{$item['quantity']}}
            </p>

{{--        @elseif($item['volume'] > 0)--}}
{{--            <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">--}}
{{--                <link itemprop="availability" href="https://schema.org/InStock">В наличии {{$item['volume']}}--}}
{{--            </p>--}}
{{--        @elseif(isset($item['stock']) && $item['stock'] > 0)--}}
{{--            <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">--}}
{{--                <link itemprop="availability" href="https://schema.org/InStock">В наличии {{$item['stock']}}--}}
{{--            </p>--}}
        @else
        
            <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">
               Склад Турция
            </p>
        @endif
    </div>
    <strong>
{{--        костыль--}}
        {!!$currency::summa($item['price'] * 100)!!}
    </strong>
</div>