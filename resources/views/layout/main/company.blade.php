<div class="d-flex justify-content-between d-print-none">
    <h2>@yield('title')</h2>
    <span class="d-print-none material-symbols-outlined cp" data-bs-toggle="collapse" data-bs-target="#company" @click="toggleExpandLess">
        <template v-if="expand">expand_less</template> 
        <template v-else>expand_more</template>
    </span>
</div>

<!-- @auth
    <p>Пользователь аутентифицирован...</p> 
@endauth

@guest
    <p>Пользователь не аутентифицирован...</p> 
@endguest -->

<div class="collapse" id="company">
    <div class="alert alert-light alert-dismissible fade show" role="alert">
        <p class="text-dark m-0">
            <strong>Грузополучатель:</strong> 
            @if($user->customer->company)
                {{$user->customer->company}}
            @else
                Нет данных
            @endif
        </p>
        <p class="text-muted m-0">
            @if($user->customer->address) {{$user->customer->address}} @else Нет данных @endif
        </p>
        <hr />
        <p class="text-muted m-0">Текущее время по указанному адресу с учетом часовых поясов: <?=date('H:i');?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert px-0 pt-2" role="alert">
        <div class="row g-2">
            <x-card-column header="Сальдо" icon="point_of_sale">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Сумма</small> 
                        <x-badge color="danger" text="-78 066.79 ₽" />
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
                </ul>
            </x-card-column>
            <x-card-column header="Задолженность" icon="production_quantity_limits">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Нормальная</small> 
                        <x-badge color="34617" text="78 066.79 ₽" />
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Просроченная</small> 
                        <span class="badge bg-light text-dark rounded-pill">0.00 ₽</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 bg-transparent">
                        <small>Текущая валюта</small> 
                        <span class="badge bg-light text-dark rounded-pill">(₽) Рубли РФ</span>
                    </li>
                </ul>
            </x-card-column>
            <x-card-column header="Договор" icon="description">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small><a href="/dashboard/document/agreement">ТДСТ/МСК/10068/ОО</a></small>  
                        <span class="badge bg-light text-dark rounded-pill">от 15.01.2020</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Отсрочка</small> 
                        <span class="badge bg-light text-dark rounded-pill">4 дня</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 bg-transparent">
                        <small>Резерв</small> 
                        <span class="badge bg-light text-dark rounded-pill">10 дней</span>
                    </li>
                </ul>
            </x-card-column>

        </div>
    </div> 
</div>