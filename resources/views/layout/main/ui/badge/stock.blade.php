{{-- <x-icon-favorite color="#b02a37" />
<small>{{rand(4, 5)}}.{{rand(0, 9)}} рейтинг</small>  --}}
@if ($stock === 'stockMercedesBenz')
    <span 
        class="badge rounded-pill text-bg-danger px-3" 
        data-bs-toggle="tooltip"
        data-bs-title="Доставка заказа осуществляется в течении 5 рабочих дней"
    >
          Срок 5 дней
    </span>
@elseif ($stock === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
    <span 
        class="badge rounded-pill text-bg-danger px-3" 
        data-bs-toggle="tooltip" 
        data-bs-title="Доставка заказа осуществляется в течении 28 рабочих дней"
    >
        <!-- Срок 28 дней -->
    </span>
@elseif ($stock === 'turkishStock')
<span 
        class="badge rounded-pill text-bg-danger px-3" 
        data-bs-toggle="tooltip"
        data-bs-title="Доставка заказа осуществляется в течении 1,2-х месяцев"
    >
          Срок 1-2 месяца
    </span>
@else
@endif