@extends('layout/main')
@section('title', 'Корзина')

@section('content')

@error('error')
    <x-alert type="danger" close="false" message="{{ $message }}" />
@enderror 
@if(session('status'))
    <div>
        <x-alert type="success" close="false" message="{{ session('status') }}" />
       <div class="w-25">
           <x-button 
                type="a" 
                text="Перейти к заказу"
                icon="arrow_right_alt"
                href="/dashboard/payment/reports/{{session('id')}}" 
              color="dark"  
          />
       </div>
        @{{newOrder}}
    </div>
@else
<template v-if="card.length === 0">
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-4">
                    <i class="material-symbols-outlined icon-card bg-soft-danger text-danger">shopping_cart</i> 
                    <span>Ваша корзина пуста</span> 
                </div>
                <div>
                    <x-button type="a" href="/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0" color="dark" text="Выбрать товар" />
                </div>
            </div>
        </div>
    </div>
</template>
@endif
@verbatim
<template v-else>
    <template v-if="!card.loading">
        <h6 v-on:click="seeData()" class="text-muted">Всего {{card.length+' '+countGoods(card.length, 'товар', 'товара', 'товаров')}}</h6>
        <ul class="list-group list-group-flush mt-4 d-grid gap-2">
            <li v-for="(item, id) in card" class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
                <small class="d-flex align-items-center gap-3" style="width: 320px">
                    <img :src="item.image" class="rounded tryimage" style="width: 50px" :alt="item.name" />
                  <!--   <a :href=`/dashboard/product/details/${item.id}` -->
                    <a class="d-flex align-items-center text-muted text-decoration-none">
                        <div class="d-flex justify-content-start flex-column">
                            <span>{{item.article}}</span>
                            <p class="fw-bold text-dark m-0">{{item.name}}</p>
                        </div>
                    </a>
                </small>
                <div class="position-relative" style="width: 180px">
                    {{ priceFormat(item.price) }}
                    <span class="badge rounded-pill text-dark bg-light">за 1 шт.</span>
                </div>
                <div style="width: 100px">
                    <span class="badge bg-soft-success text-success">
                        <span class="legend-indicator bg-success"></span>
                        <span v-html="resultSumma(item.price, item.count)"></span>
                    </span>
                </div>
                <div class="input-group" style="width: 140px">
                    <button class="btn btn-sm material-symbols-outlined pe-0" v-on:click="inCrement(item.id)">add</button>
                    <div class="form-control form-control-sm fs-6 border-0 text-center">{{item.count}}</div>
                    <button class="btn btn-sm material-symbols-outlined ps-0" v-if="item.count == 1">remove</button>
                    <button class="btn btn-sm material-symbols-outlined ps-0" v-on:click="deCrement(item.id)" v-else>remove</button>
                </div>
                <div class="btn-group">
                    <button v-on:click="removeCart(id)" class="btn text-danger rounded material-symbols-outlined">delete</button>
                </div>
            </li>
        </ul>
        <div class="d-flex justify-content-between">
            <div class="col-md-6 mt-3">
                <p class="m-0 text-muted">
                    <small>
                        Нажимая кнопку "Оформить заказ" вы соглашаетесь с нашей 
                        <a href="/doc/privatepolice" target="_blank" class="text-muted">политикой конфиденциальности</a> и
                        <a href="/doc/license" target="_blank" class="text-muted">пользовательским соглашением</a>                
                    </small>
                </p>
            </div>
            <div class="d-flex justify-content-end gap-4 align-items-center mt-3 mb-5">
                <div class="py-2">Всего:</div>
                <div class="py-2 fw-bold pe-4">
                    {{getTotalsumma(totalsumma)}}
                </div>
                <div class="py-2">{{amount}} (шт.)</div>

                <form action="/checkout" method="post" class="py-2">
                    <input type="hidden" name="_token" value="<?=csrf_token();?>" />
                    <input type="hidden" name="name" :value="JSON.stringify(checkout)" />
                    <button v-on:click="Checkout('<?=$user->verified?>')" class="btn btn-dark px-4 d-flex align-items-center gap-2 justify-content-center">
                        <span class="material-symbols-outlined" v-if="checkout.length === 0">check</span>
                        <span class="material-symbols-outlined spin" v-else>autorenew</span>
                        {{checkout.length !== 0 ? 'Отправляем...' : 'Оформить заказ'}}
                    </button>
                </form>

            </div>    
        </div>
        {{totalSum}}
        {{totalAmount}}
    </template>
    <template v-else>
        <h6 class="text-muted">Подгружаем товары...</h6>
    </template>
</template>
@endverbatim

@endsection