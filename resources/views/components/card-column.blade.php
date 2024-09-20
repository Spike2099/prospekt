<div class="col-md-4">
    <div class="rounded bg-white shadow-sm h-100">
        <div class="d-flex align-items-center p-3 justify-content-between">
            <strong class="fs-5">{{ $header }}:</strong>
            <span class="material-symbols-outlined icon-card bg-soft-danger text-danger">{{$icon}}</span>
        </div>
        {{ $slot }}
        <!-- <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <small>Сумма</small> 
                <span class="badge bg-light text-danger rounded-pill">-78 066.79 ₽</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <small>Кредит / Остаток:</small> 
                <span class="badge bg-light text-primary rounded-pill">
                    500 000.00 ₽ 
                    <span class="text-muted"> / </span>
                    <span class="text-success">384 640.71 ₽</span> 
                </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center cp border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#address">
                <small><b>Способ получения:</b></small> 
                <span class="badge bg-light text-primary rounded-pill">
                    Самовывоз
                </span>
            </li>
            <div class="collapse" id="address">
                <li class="list-group-item border-0 bg-transparent border-top">
                    <a href="#"><small>Москва МКАД 86 км</small></a>  
                </li>                                    
            </div>

        </ul> -->
    </div>
</div>