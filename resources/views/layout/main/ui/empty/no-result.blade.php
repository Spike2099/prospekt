@if (!empty($analog['rows']))
    <x-alert type="warning" header=" " message="По запросу <strong>{{$text}}</strong> нашлись аналоги:" />
    <div class="row g-2"> 
        @foreach($analog['rows'] as $item)
            @if (isset($dashboard))
                @include('layout.main.ui.empty.dashboard.card')
            @else 
                @include('layout.main.ui.empty.index.card')
            @endif
        @endforeach
    </div>
@else
    @if (is_numeric(mb_substr($text, 1)))
        <p class="w-100 bg-body-secondary rounded px-4 py-3">
            По запросу <strong>"{{$text}}"</strong> ничего не найдено
        </p>        
    @else
        <x-alert type="warning" header="Ошибка!" message="Артикул <strong>{{$text}}</strong> не найден" />
    @endif
@endif
<ul class="text bg-white rounded ps-5 pe-4 py-3 shadow-sm mt-4">
    <li>Попробуйте поискать запчасть без буквы в начале артикула</li>
    <li>Попробуйте указать латинскую букву в начале артикула</li>
</ul>
<div class="row g-2 py-5">
    <div class="col-12 col-lg-4">
        <div class="bg-body-secondary rounded px-4 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text text-muted">Каталог</span> 
                    <h3>Mercedes-Benz</h3>
                    <a href="{{$link ?? '/products/mercedes-benz'}}" class="text-primary text-decoration-none text-uppercase">
                        <span style="font-family: ui-monospace">←</span>
                        Назад в каталог
                    </a> 
                </div>
                <img src="/img/mercedes-benz.png" class="w-25 h-25" />
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="bg-body-secondary rounded px-4 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text text-muted">Написать</span> 
                    <h3 class="text">Менеджеру</h3>
                    <a href="mailto:info@prospekt-parts.com" class="text-primary text-decoration-none">info@prospekt-parts.com</a>
                </div>
                <img src="/img/contact/newsletter.png" class="w-25" />
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="bg-body-secondary rounded px-4 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text text-muted">Позвонить</span> 
                    <h3 class="text">Менеджеру</h3>
                    <a href="tel:89017331866" class="text-primary text-decoration-none">+7 (901) 733-18-66</a>
                </div>
                <img src="/img/headphones.png" class="w-25" />
            </div>
        </div>
    </div>
</div>