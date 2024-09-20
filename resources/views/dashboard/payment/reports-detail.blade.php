@extends('layout/main')

@section('title', isset($data['id']) ? 'Заказ #'.$data['id'] : 'Заказ не найден')

@section('breadcrumbs')
<div class="d-flex gap-2">
    <a href="/dashboard/orders" class="text-muted">Заказы</a>
    <span class="text-secondary">/</span>
      
    <span class="text-muted">Детали заказа</span>
</div>
@endsection
@section('content')

@if(!isset($data))
<x-alert type="danger" message="ID: {{$order}} не найден. Либо заказ был удалён." />
@else
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <x-badge color="{{$data['status'] === 'В работе' ? 15106326 : 34617}}" text="{{$data['status']}}" />
            <span class="d-flex align-items-center gap-2 ms-2 ms-sm-3 text-secondary">
                <span class="material-symbols-outlined">calendar_month</span> 
                {{$time::parse($data['creation_date'])->locale('ru')->translatedFormat('d F Y, H:i:s')}}
            </span>
        </div>
        <div class="d-flex gap-3 d-print-none">
                       Выставление счёта 
          <a 
               href="javascript:;" 
               onclick="window.print(); return false;" 
               class="d-flex align-items-center gap-2 text-body text-decoration-none"
            >
                <span class="material-symbols-outlined text-secondary">print</span>
                Распечатать
            </a>
            @if(isset($data['invoicesOut']))
                <x-button 
                    type="a" 
                   size="sm" 
                    color="secondary"
                   href="/dashboard/payment/order/{{$data['invoicesOut'][0]['id']}}" 
                   text="Посмотреть счёт" 
                    icon="visibility"
                />
           @else
           <form action="/dashboard/create/invoice" method="post">
                @csrf
               <input type="hidden" name="id" value="{{$order}}">
               <x-button 
                    type="submit" 
                    size="sm" 
                    color="danger"
                    text="Запросить счёт"
                    icon="credit_score" 
               />
            </form>

            @endif
            
            <div class="dropdown">
                <a 
                    href="javascript:;" 
                    id="moreOptionsDropdown" 
                    data-bs-toggle="dropdown" 
                    class="d-flex align-items-center gap-1 text-body text-decoration-none"
                >
                    <span class="material-symbols-outlined text-secondary">more_vert</span>
                </a> 
                <div aria-labelledby="moreOptionsDropdown" class="dropdown-menu mt-1" style="">
{{--                    setStatus('in_progress')--}} в строке ниже
                    <a href="#" class="d-flex align-items-center gap-2 dropdown-item" @click="changeOrderStatus('{{$order}}', 'В работе')">
                          <span class="material-symbols-outlined fs-6 text-secondary">difference</span>
                          Заказ в работе
                    </a>

                    <a href="#" class="d-flex align-items-center gap-2 dropdown-item" @click="changeOrderStatus('{{$order}}', 'Завершён')">
                        <span class="material-symbols-outlined fs-6 text-secondary">inventory_2</span>
                        Заказ выполнен 
                    </a>
                    
                   <a href="#" class="d-flex align-items-center gap-2 dropdown-item" @click="changeOrderStatus('{{$order}}', 'Отменён')">
                        <span class="material-symbols-outlined fs-6 text-secondary">block</span>
                        Отменить заказ
                   </a>
                   
                </div>
            </div>
        </div>
    </div>

    <hr />
    <div class="row">
        <div class="mb-3 mb-lg-0" :class="[close ? 'col-lg-12' : 'col-lg-8']">
            <div class="card border-0 shadow-sm mb-3 mb-lg-5">
                <div class="card-header border-light bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0 mt-1">
                        Информация по заказу 
                        <span class="badge bg-soft-danger text-danger rounded-circle ms-1">
                        {{count($data['items'])}}
                        </span>
                    </h5>
                    <span class="material-symbols-outlined cp" @click="close = false" v-if="close">open_in_new</span>
                    <!-- <a href="javascript:;" class="text-secondary"><span class="material-symbols-outlined fs-6">edit</span></a> -->
                </div>
                <div class="card-body">
                    @foreach($data['items'] as $product)
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-xl">
                                <img src="/img/no_photo.jpg" alt="..." class="img-fluid rounded">
                            </div>
                         </div>
                         
                         <div id = "shop">
                         <div class="flex-grow-1 ms-3">
                            <div class="row">
                              <div class="col-md-5 mb-3 mb-md-0">
                                {{$product['name']}}
                                <div class="fs-6 text-secondary">
                                  <span class="fw-semibold">Артикул:</span> 
                                  <span>{{$product['article']}}</span>
                                </div>
                                <div class="fs-6 text-secondary">
                                  <span>{{$categories[$product['stock_category_id']]}}</span>
                                </div>
                              </div>
                             <div class="col-lg-2 px-0 align-self-center">
                                  
                                    <span v-if="status === 'in_progress'">
                                      <input v-model="product.price" type="text">
                                    </span>
                                    <span v-else>
                                      @php echo number_format(($product['price']) / 100, 2, '.', ' ') @endphp ₽
                                    </span>
                                  
                                </div>
                                <div class="col align-self-center">
                                  
                                    <span v-if="status === 'in_progress'">
                                      <input v-model="product.quantity" type="text"> шт
                                    </span>
                                    <span v-else>
                                      {{$product['quantity']}} шт
                                    </span>
                                  
                                </div>

                              <div class="col-lg-3 ps-0 align-self-center text-end">
                                <h6 class="m-0 pe-2">
                                  @php echo number_format(($product['price']*$product['quantity']) / 100, 2, '.', ' ') @endphp ₽
                                </h6>
                              </div>
                            </div>
                          </div>  </div>
                    </div>
                    <hr class="border-muted my-2" />
                    @endforeach
                    <div class="row justify-content-md-end">
                        <div class="col-lg-9">
                            <dl class="row text-sm-end m-0">
{{--                                <dt class="col-sm-6 text-muted fw-light">Промежуточный итог:</dt>--}}
{{--                                <dd class="col-sm-6 fw-bold">--}}
{{--                                    @php echo number_format(($data['sum']) / 100, 2, '.', ' ') @endphp ₽--}}
{{--                                </dd>--}}
{{--                                <dt class="col-sm-6 text-muted fw-light">Выплаченная сумма:</dt>--}}
{{--                                <dd class="col-sm-6 fw-bold">--}}
{{--                                    @php echo number_format(($data['payedSum']) / 100, 2, '.', ' ') @endphp ₽--}}
{{--                                </dd>                            --}}
{{--                                <!-- <dt class="col-sm-6 text-muted fw-light">Стоимость доставки:</dt>--}}
{{--                                <dd class="col-sm-6 fw-bold">0.00 ₽</dd> -->--}}
{{--                                <dt class="col-sm-6 text-muted fw-light">Налог:</dt>--}}
{{--                                <dd class="col-sm-6 fw-bold">--}}
{{--                                    @php echo number_format(($data['vatSum']) / 100, 2, '.', ' ') @endphp ₽--}}
{{--                                </dd>--}}
                                <dt class="col-sm-6 text-muted fw-light">Итого:</dt>
                                <dd class="col-sm-6 fw-bold">
                                    @php echo number_format(($data['total_sum']) / 100, 2, '.', ' ') @endphp ₽
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
{{--            @if(isset($data['deliveryPlannedMoment']))--}}
{{--            <p>--}}
{{--                <small class="d-flex align-items-center gap-2">--}}
{{--                    <span class="material-symbols-outlined fs-5 text-secondary">info</span> --}}
{{--                    Запланированное время доставки: --}}
{{--                    {{$time::parse($data['deliveryPlannedMoment'])->locale('ru')->translatedFormat('d F Y, H:i')}}--}}
{{--                </small>--}}
{{--            </p>--}}
{{--            @endif--}}
        </div>
        <div class="col-lg-4 d-print-none" :class="[close ? 'd-none' : '']">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-light bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0 mt-1">Покупатель</h5> 
                    <span class="material-symbols-outlined cp" @click="close = true">close</span>
                </div>
                <div class="card-body px-0 pb-2">
                    <ul class="list-group list-group-flush list-group-no-gutters">
                        <li class="list-group-item border-light">
                            <a href="/dashboard/settings/profile" class="d-flex align-items-center text-decoration-none">
                                <div>
                                    <span class="material-symbols-outlined bg-soft-danger text-danger icon-card">apartment</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="text-body text-inherit">
                                        {{$data['customer']['name']}}
                                    </span>
                                </div>
                                <div class="flex-grow-1 text-end"><i class="bi-chevron-right text-body"></i></div>
                            </a>
                        </li>
                        <!-- <li class="list-group-item">
                            <a href="./ecommerce-customer-details.html" class="d-flex align-items-center text-muted text-decoration-none">
                                <div style="
                                    height: 20px;
                                    "><span class="material-symbols-outlined fs-5 text-secondary">shopping_cart_checkout</span></div>
                                <div class="flex-grow-1 ms-3"><span class="text-body text-inherit">7 заказов</span></div>
                                <div class="d-flex align-items-center text-end"><span class="material-symbols-outlined text-secondary">keyboard_arrow_right</span></div>
                            </a>
                        </li> -->
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold">Контактная информация</h6>
                                <!-- <a href="javascript:;" class="text-secondary"><span class="material-symbols-outlined fs-6">edit</span></a> -->
                            </div>
                            <ul class="list-unstyled list-py-2 text-body">
                                @if (isset($data['customer']['email']))
                                <li class="d-flex gap-2 align-items-center">
                                    <span class="material-symbols-outlined fs-6 text-secondary">mail</span>
                                    {{$data['customer']['email']}}
                                </li>                                    
                                @endif
                                @if (isset($data['customer']['phone']))
                                <li class="d-flex gap-2 align-items-center">
                                    <span class="material-symbols-outlined fs-6 text-secondary">phone_iphone</span>
                                    {{$data['customer']['phone']}}
                                </li>
                                @endif
                            </ul>
                        </li>
{{--                        <li class="list-group-item">--}}
{{--                            <div class="d-flex justify-content-between align-items-center">--}}
{{--                                <h6 class="fw-bold">Фактический адрес</h6>--}}
{{--                                <!-- <a href="javascript:;" class="text-secondary"><span class="material-symbols-outlined fs-6">edit</span></a> -->--}}
{{--                            </div>--}}
{{--                            <small class="d-block text-muted">--}}
{{--                            {{$data['customer']['address']}}--}}
{{--                            <img src="/img/flags/russia_flag.svg" alt="Great Britain Flag" class="border rounded-circle avatar avatar-xss avatar-circle ms-1"></small>--}}
{{--                        </li>--}}
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold">Адрес для выставления счета</h6>
                                <!-- <a href="javascript:;" class="link"><span class="material-symbols-outlined">edit</span></a> -->
                            </div>
                            @if (isset($data['customer']['address']))
                            <small class="d-block text-muted">
                                {{$data['customer']['address']}}
                                <img src="/img/flags/russia_flag.svg" alt="Great Britain Flag" class="border rounded-circle avatar avatar-xss avatar-circle ms-1">
                            </small>    
                            @else
                            <small class="d-block text-danger">
                                Адрес для выставления счёта отсутствует !
                            </small>                      
                            @endif
                            <div class="mt-3 d-grid">
                                <!-- <h6 class="fw-bold mb-0">Mastercard</h6>
                                <span class="d-block text-body">
                                Номер карты: 
                                <span class="text-muted"><sub class="h5">**** **** ****</sub> 4291</span>
                                </span> -->
                                <x-button 
                                    type="button" 
                                    color="dark" 
                                    text="связаться с менеджером" 
                                    icon="headset_mic" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#manager" 
                                />
                            </div>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        




    <div class="modal fade" id="manager" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content border-0" novalidate @submit.prevent="SendManager('{{$order}}')" v-if="!send">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5">Обратная связь</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="mt-2">
                        <textarea 
                            rows="5" 
                            class="form-control" 
                            :class="[error.message && message === '' ? 'is-invalid' : '']"
                            v-model="message" 
                            placeholder="Опишите здесь ваш вопрос..."
                        >
                        </textarea>
                        <div class="invalid-feedback d-block m-0" v-if="error.message && message === ''">
                            Пожалуйста, напишите ваш вопрос.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="btn btn-outline-light text-dark px-3" data-bs-dismiss="modal">Отмена</div>
                    <button type="submit" class="btn btn-dark px-4 d-flex align-items-center gap-2 justify-content-center" v-if="!loading">
                        <span class="material-symbols-outlined spin">autorenew</span>
                        Отправляю...
                    </button>
                    <x-button color="dark" icon="forward" type="submit" text="Отправить менеджеру" v-else v-on:click="Sender" />
                </div>
            </form>
            <div class="modal-content border-0" v-else>
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5">Обратная связь</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <x-alert type="success" message="Ваша заявка принята." close="false" />
                </div>
            </div>
        </div>
    </div>
@endif
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@endsection