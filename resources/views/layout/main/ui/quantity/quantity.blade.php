<div class="d-flex align-items-center justify-content-between gap-2">
    <div>
            @if($item['quantity'] > 0)
				<p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">
                    <link itemprop="availability" href="https://schema.org/InStock">В наличии {{$item['quantity']}}
                </p>

            @elseif($item['volume'] > 0)
                <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">
                    <link itemprop="availability" href="https://schema.org/InStock">В наличии {{$item['volume']}}
                </p>
           @elseif(isset($item['stock']) && $item['stock'] > 0)
                <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">
                    <link itemprop="availability" href="https://schema.org/InStock">В наличии {{$item['stock']}}
                </p>
            @else
				 <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="text-danger">
                    Нет наличии
                </p>
			@endif
    </div>
    <strong>
        {!!$currency::summa($item['salePrices'][0]['value'])!!}
    </strong>
</div>