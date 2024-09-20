@php
    $datetime = $time::now()->addHours(3)->locale('ru')->translatedFormat('l, j F Y, H:i');
    $uuid = auth()->user()->verified;
    $path = './img/goods/'.$product['article'].'.jpg';
    $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';
@endphp

@extends('layout/main')
@section('title', $product['name'])

@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    @if($product['name'] === 'Товар не найден')
    <span class="text-muted">{{$product['name']}}</span>
    @else
    <a href="/dashboard/catalog/category/{{$product['catalog']['id']}}" class="text-muted">
        {{$product['catalog']['name']}}
    </a>  
    <span class="text-secondary">/</span>
    <span class="text-muted">Информация об {{$product['article']}}</span>    
    @endif
</div>
@endsection


@section('content')
    @if($product['name'] === 'Товар не найден')
        @if (session('status'))
            <x-alert type="success" close="false" message="{{ session('status') }}" />
        @else
            <x-alert type="danger" close="false" message="Товар удалён или не верно указан ID товара" />
            <form action="" method="post" class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="fw-bold m-0">Связаться с менеджером</h5>
                </div>
                
                <div class="card-body">
                    @csrf
                    <input type="hidden" name="date" value="{{$datetime}}">
                    <input type="hidden" name="company" value="{{$uuid}}">
                    <input type="hidden" name="message" value="ID товар {{$id}} не найден">
                    <input type="hidden" name="id" value="{{$id}}" />
                    <input type="hidden" name="num" value="{{time()}}" />
                    <div class="mb-2">
                        <label>Ваше имя</label>
                        <input type="text" class="form-control" name="name" value="" />
                    </div>
                    <div>
                        <label>Ваш телефон</label>
                        <input type="text" class="form-control" name="phone" value="" />
                    </div>
                </div>
                <div class="card-footer bg-white border-light">
                    <x-button type="submit" color="dark" text="Отправить" icon="forward_to_inbox" />
                </div>
            </form>        
        @endif

    @else
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if ($product['catalog']['id'] === 'stockMercedesBenz')
                        <x-alert 
                            type="warning" 
                            header="Внимание: " 
                            message="Доставка предзаказа осуществляется <strong>в течении 5 рабочих дней!</strong>"
                        />
                    @elseif ($product['catalog']['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
                        <x-alert 
                            type="warning" 
                            header="Внимание: " 
                            message="Доставка заказа осуществляется <strong>в течении 28 рабочих дней!</strong>"
                        />
                    @else
                    @endif
                </div>                
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    @role('customer')
                        <img 
                            src="{{$image}}"
                            alt="{{$product['name']}}" 
                            class="w-100 rounded" 
                        /> 
                    @endrole
                    @role('admin')
                    <div class="position-relative">
                        @if ($image !== '/img/placeholder.png')
                        <div class="position-absolute delete-image" @click="deleteImageFromGood('{{$product['article']}}', '{{$id}}')">
                            <span class="material-symbols-outlined">delete</span>
                        </div>                             
                        @endif
                        <div v-if="goods.delete" class="position-absolute delete-image" @click="deleteImageFromGood('{{$product['article']}}', '{{$id}}')">
                            <span class="material-symbols-outlined">delete</span>
                        </div> 
                        <label>
                            <img v-if="goods.image" :src="goods.image" alt="{{$product['name']}}" class="w-100 rounded" />
                            <img v-else 
                                id="isEmptyImage"
                                src="{{$image}}" 
                                alt="{{$product['name']}}" 
                                class="w-100 rounded" 
                            />

                            <input 
                                type="file" 
                                name="file" 
                                data-uuid="{{$id}}"
                                data-article="{{$product['article']}}"
                                @change="selectImageFromGood($event)" 
                                accept="image/jpeg" 
                                class="d-none" 
                            />
                            <template v-if="goods.loading">
                                <div class="d-flex align-items-center justify-content-center w-100 h-100 position-absolute top-0 start-0" style="background: #ffffffa6">
                                    <span class="spinner-border spinner-border-sm text-danger"></span>
                                    &#160;Загружаем фото...                                   
                                </div>
                            </template>
                        </label>                                             
                    </div>

                    @endrole
                </div>
                <div class="col-md-6">
                    <p class="mb-1">
                        <b>Артикул:</b>
                        {{$product['article']}}
                    </p>
                    <!-- <p class="mb-1">
                        <b>Внешний код:</b>
                        {{--$product['externalCode']--}}
                    </p> -->
                    <p class="mb-1">
                        <b>НДС:</b>
                        {{$product['vat']}}%
                    </p>

                    <p class="mb-1">
                        <b>Цена <i class="fw-light text-muted">(за 1 шт.)</i>:</b>
                        @php echo number_format(($product['salePrices']) / 100, 2, '.', ' ') @endphp ₽
                    </p>

                    <p class="mb-1">
                        <b>Тип маркеровки:</b>
                        {{$product['trackingType']}}
                    </p>
                    <p class="mb-1">
                        <b>Обновлён:</b>
                        <small class="fw-light text-muted">
                            {{$time::parse($product['updated'])->locale('ru')->translatedFormat('d F Y, H:i')}}
                        </small>
                    </p>
                    <!-- <div class="mb-3">
                        <label class="form-label fw-bold m-0">ID {{--$product['paymentItemType']--}}а:</label>
                        <input type="text" name="id" class="form-control" value="{{--$product['id']--}}" placeholder="Идентификатор..." />
                        <div class="form-text">Вы можете сообщить этот ID менеджеру при поиске данной позиции</div>
                    </div> -->

                    <p>
                        @if ($product['catalog']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175')
                            @if($product['quantity'] == 0)
                                <div class="badge bg-soft-danger text-danger px-3">
                                    Нет в наличии
                                </div>
                            @else
                                <div class="badge bg-soft-success px-3">
                                    <div class="d-flex align-items-center gap-2 text-success">
                                        В наличии 
                                        <span class="badge bg-success">{{$product['quantity']}}</span>                                
                                    </div>
                                </div>
                            @endif                            
                        @else
                            @if($product['quantity'] == 0)
                                <div class="badge bg-soft-danger text-danger px-3">
                                    Нет в наличии
                                </div>
                            @else
                                <div class="badge bg-soft-success px-3">
                                    <div class="d-flex align-items-center gap-2 text-success">
                                        В наличии 
                                        <span class="badge bg-success">{{$product['quantity']}}</span>                                
                                    </div>
                                </div>
                            @endif 
                        @endif
                    </p>
                    <div class="d-flex">
                        <div>
                            @if($product['quantity'] == 0)
                                <div  
                                    id="preorders1"
                                    data-order="{{$product['id']}},{{$product['article']}},{{$product['name']}},1,{{$product['salePrices']}},{{$image}}"
                                    v-on:click="addToOrder('s1')"
                                >
                                    <button class="btn btn-secondary px-4 d-flex align-items-center gap-2 justify-content-center">
                                        <x-icon-add-card color="#fff" />
                                        Предзаказ
                                    </button>
                                </div>
                            @else
                                <div 
                                    id="cards1" 
                                    class="d-flex flex-column"
                                    data-card="{{$product['id']}},{{$product['article']}},{{$product['name']}},{{$product['stock_category_id']}},1,{{$product['salePrices']}},{{$product['salePrices']}},{{$image}}"
                                    v-on:click="addToCard('s1')"
                                >
                                    <button class="btn btn-lg btn-dark px-4 d-flex align-items-center gap-2 justify-content-center">
                                        <x-icon-add-card color="#fff" />
                                        В корзину
                                    </button>
                                </div>
                            @endif                             
                        </div>
                    </div>
                </div>
                @role('admin')
                <div class="col-md-3">
                    <div class="text-center py-3">
                        @if($product['barcodes'] === 'Нет данных')
                        @else
                        {!! DNS1D::getBarcodeSVG($product['barcodes'], 'EAN13', 1.7,60) !!}
                        @endif
                    </div>
                </div>
                @endrole
            </div>  
            @role('admin') 
            <div class="row">
                <div class="col-12 mt-4">
                    <label class="fw-bold">Описание товара:</label>
                    <textarea id="editor" name="description" >
                        @if ($images::text($id)['description'])
                            {{$images::text($id)['description']}}
                        @else
                            <strong>Материал:</strong> нет данных<br /> 
                            <strong>Описание:</strong> нет данных<br />
                            <strong>Производитель:</strong> Daimler Truck AG.<br />
                            <strong>Адрес:</strong> Россия, Московская область, г. Мытищи.                            
                        @endif
                    </textarea>
                    <div class="d-flex gap-2 mt-2">
                        <button 
                            type="submit" 
                            v-on:click="editText('{{$id}}')" 
                            class="btn px-4"
                            :class="[loading !== true ? 'btn-dark' : 'btn-secondary']"
                            v-html="loading !== true ? 'Подождите, грузится...' : 'Сохранить'"
                        ></button>
                        <a href="/product/mercedes-benz/{{$id}}" target="_blank" class="btn btn-light px-4">
                            Посмотреть
                        </a>
                        <a href="https://api.moysklad.ru/app/#good/edit?id={{$id}}" target="_blank" class="btn material-symbols-outlined">
                            open_in_new
                        </a>                        
                    </div>
                </div>
            </div> 
            @endrole  
            @role('customer')
                <hr />
                <div class="w-100 mt-4">
                    {!! $images::text($id)['description'] !!} 
                </div>
            @endrole      
        </div>
    </div>
    @endif
@endsection