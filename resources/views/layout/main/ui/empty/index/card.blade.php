@if(isset($item['article']))
    <div class="container">
        <div class="row border-bottom py-3 d-flex align-items-center">
    <!-- Изображение -->
            <div class="col-12 col-md-1 d-flex align-items-center">
                <a href="/product/mercedes-benz/{{$item['id']}}">
                    <img 
                        loading="lazy"
                        itemprop="image"
                        src="{{$images::src($item['id'])}}" 
                        class="img-fluid rounded" 
                        alt="{{$item['name']}}, Проспект Партс, {{$item['pathName']}}"
                    />
                </a>
            </div> 

            <!-- Бренд/Артикул -->
            <div class="col-12 col-md-2">
          <!--       <strong>Бренд/Артикул:</strong> -->
                <p class="mb-0">
                    <a itemprop="name" href="/product/mercedes-benz/{{$item['id']}}" class="text-decoration-none">
                    {{ $item['productFolder']['name'] }}
                    </a>
                </p>
            </div>
            
            <div class="col-12 col-md-2">
          <!--       <strong>Бренд/Артикул:</strong> -->
                <p class="mb-0">
                    <a itemprop="name" href="/product/mercedes-benz/{{$item['id']}}" class="text-decoration-none">
                     {{$item['article']}}
                    </a>
                </p>
            </div>
            
            

            <!-- Наименование -->
            <div class="col-12 col-md-2">
            <a itemprop="name" href="/product/mercedes-benz/{{$item['id']}}" class="text-decoration-none">
       <!--          <strong>Наименование:</strong> -->
                <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
            </a>
            </div>

            <div class="col-12 col-md-1">
                <!--  <strong>Наличие:</strong> -->
                <p class="mb-0">
                    <span class="{{ $item['quantity'] == 0 ? 'text-danger' : 'label' }}">
                        <link itemprop="availability" href="https://schema.org/{{ $item['quantity'] == 0 ? 'OutOfStock' : 'InStock' }}">
                        {{ $item['quantity'] == 0 ? 'Нет в наличии' : $item['quantity'] }}
                    </span>
                </p>
            </div>
            
            <!-- Сроки Доставки -->
            <div class="col-12 col-md-2">
                <!-- <strong>Сроки Доставки:</strong> -->
                <p class="mb-0">
                    <span class="badge rounded-pill {{ $item['quantity'] == 0 ? 'text-bg-danger' : 'text-bg-success' }} px-3" 
                        data-bs-toggle="tooltip"
                        data-bs-title="{{ $item['quantity'] == 0 ? 'Товара нет в наличии' : 'Доставка заказа осуществляется в течении 2 рабочих дней' }}">
                        {{ $item['quantity'] == 0 ? 'Нет в наличии' : 'В наличии' }}
                    </span>
                </p>
            </div>


            <!-- Цена -->
            <div class="col-12 col-md-1 text-center text-nowrap">
            <!--     <strong>Цена:</strong> -->
                <p class="mb-0 text-center text-nowrap">{!! $currency::summa($item['salePrices'][0]['value']) !!}</p>
            </div>

            <!-- Кнопка добавления в корзину -->
            <div class="col-12 col-md-1 d-flex align-items-center justify-content-end">
                <div>
                    @if($item['quantity'] == 0)
                        <div onclick="isNotSignUp()" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                            <x-icon-add-card size="25px" color="#fff"/>
                        </div>
                    @else
                        <div id="card{{$item['id']}}" data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},moysklad,1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}" v-on:click="addToCard('{{$item['id']}}')" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                            <x-icon-add-card size="25px" color="#fff"/>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif