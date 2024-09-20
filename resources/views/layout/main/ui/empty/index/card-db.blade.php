@if(isset($item['article']))
    <div class="container">
        <div class="row border-bottom py-3 d-flex align-items-center">
            <!-- Изображение -->
<div class="col-12 col-md-1 d-flex align-items-center">
    @php
        $path = './img/goods/'.$item['article'].'.jpg';
        $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';
    @endphp
    <a href="/{{$item['link']}}/{{$item['id']}}">
        <img 
            loading="lazy"
            itemprop="image"
            src="{{$image}}" 
            class="img-fluid rounded" 
            alt="{{$item['article']}}, Проспект Партс, {{$item['article']}}"
        />
    </a>
</div>

            <!-- Бренд/Артикул -->
            <div class="col-12 col-md-2">
              <!--   <strong>Бренд/Артикул:</strong> -->
                <p class="mb-0">
                    <a itemprop="name" href="/{{$item['link']}}/{{$item['id']}}" class="text-decoration-none">
                        Mercedes-Benz
                    </a>
                </p>
            </div>
            
             <div class="col-12 col-md-2">
              <!--   <strong>Бренд/Артикул:</strong> -->
                <p class="mb-0">
                    <a itemprop="name" href="/{{$item['link']}}/{{$item['id']}}" class="text-decoration-none">
                    {{$item['article']}}
                    </a>
                </p>
            </div>
            
            

            <!-- Наименование -->
            <div class="col-12 col-md-2">
               <!--  <strong>Наименование:</strong> -->
            <a itemprop="name" href="/{{$item['link']}}/{{$item['id']}}" class="text-decoration-none">
                <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
            </a>
            </div>

            <!-- Наличие -->
            <div class="col-12 col-md-1 position-relative">
             <!--    <strong>Наличие:</strong> -->
                <p class="mb-0">
                    <span itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}">
                        <link itemprop="availability" href="https://schema.org/InStock">
                        {{$item['quantity'] == 0 ? 'Нет в наличии' : ($item['link'] == 'product' ? $item['quantity'] : 'Турция')}}
                    </span>
                </p>
                 <span class="hover-text-turkey">Товар находится в Турции, уточняйте сроки у менеджера</span>
            </div>
            
            <div class="col-12 col-md-2">
                 <!--     <strong>Сроки Доставки:</strong> -->
                         <p class="mb-0">
                         @include(($item['stock_category_id'] == 'colyman' ? 'colyman' : 'product') . '.card.remdays')
                        </p>
            </div>
{{--            <div class="col-12 col-md-2">--}}
{{--                <!--    <strong>Сроки Доставки:</strong> -->--}}
{{--                <p class="mb-0">--}}
{{--                    <span class="badge rounded-pill text-bg-danger px-3"--}}
{{--                          data-bs-toggle="tooltip"--}}
{{--                          data-bs-title="Доставка заказа осуществляется в течении 2 рабочих дней">--}}
{{--                        Срок {{$item['stock_category_id'] == 'colyman' ? '1-2 месяца' : '5 дней'}}--}}
{{--                    </span>--}}
{{--                </p>--}}
{{--            </div>--}}

            <!-- Цена -->
            <div class="col-12 col-md-1 text-center text-nowrap">
         <!--        <strong>Цена:</strong> -->
                <p class="mb-0 text-center text-nowrap">{!!$currency::summa($item['price'] * 100)!!}</p>
            </div>

            <!-- Кнопка добавления в корзину -->
            <div class="col-12 col-md-1 d-flex align-items-center justify-content-end">
                <div>
                    @if($item['quantity'] == 0)
                        <div onclick="isNotSignUp()" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                            <x-icon-add-card size="25px" color="#fff"/>
                        </div>
                    @else
                        <div id="card{{$item['id']}}" data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id'] ?? 'colyman'}},1,{{$item['price']* 100}},{{$item['price']* 100}},{{$images::src($item['article'])}}" v-on:click="addToCard('{{$item['id']}}')" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                            <x-icon-add-card size="25px" color="#fff"/>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
