@extends('layout/main')
@section('title', 'Предзаказы')

@section('content')

@if(session('status'))
    <x-alert type="success" close="false" message="{{ session('status') }}" />
    <div class="w-25">
        <x-button 
            type="a" 
            text="Посмотреть"
            icon="arrow_right_alt"
            href="/dashboard/payment/preorder/{{session('id')}}" 
            color="dark"  
        />
    </div>
@else

<template v-if="preorder.length === 0">
    <h6 class="text-muted">Заказов нет</h6>
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-4">
                    <i class="material-symbols-outlined icon-card bg-soft-danger text-danger">upcoming</i> 
                    <span>Пусто, заказов на рассмотрении нет</span>
                </div>
                <div>
                    <x-button type="a" href="/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0" color="dark" text="Выбрать товар" />
                </div>
            </div>
            </br>
                <div class="d-flex align-items-center gap-4">
                    <i class="material-symbols-outlined icon-card bg-soft-danger text-danger">chat</i> 
                    Также вы можете сделать предзаказ позиций которых нет в наличии</span>
                    <span>Сроки доставки уточнятей у менеджера!</span>
                </div>
            
        </div>
    </div>
</template>
<template v-else>
    <h6 class="text-muted">Всего @{{preorder.length+' '+countGoods(preorder.length, 'заказ', 'заказа', 'заказов')}}</h6>
    <ul class="list-group list-group-flush mt-4 d-grid gap-2">
        <li v-for="(item, id) in preorder" class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
            <small class="d-flex align-items-center gap-3" style="width: 320px;">
                <img src="/img/placeholder.png" :alt="item.name" class="rounded" style="width: 50px" /> 
                <a :href=`/dashboard/product/details/${item.id}` class="d-flex align-items-center text-muted text-decoration-none">
                    <div class="d-flex justify-content-start flex-column">
                        <span>@{{item.article}}</span> 
                        <p class="fw-bold text-dark m-0">@{{item.name}}</p>
                    </div>
                </a>
            </small>
            <div class="position-relative" style="width: 180px;">
                Цена
                <span class="badge rounded-pill text-dark bg-light">за 1 шт.</span>
            </div>
            <div style="width: 100px;">
                <span class="badge bg-soft-success text-success">
                    <span class="legend-indicator bg-success"></span>
                    По договорённости
                </span>
            </div>
            <div class="input-group" style="width: 140px;">
                <button class="btn btn-sm material-symbols-outlined pe-0" @click="inPreCrement(item.id)">add</button> 
                <div class="form-control form-control-sm fs-6 border-0 text-center">
                    @{{item.count}}
                </div>
                <button class="btn btn-sm material-symbols-outlined ps-0" v-if="item.count == 1">remove</button>
                <button class="btn btn-sm material-symbols-outlined ps-0" @click="dePreCrement(item.id)" v-else>remove</button>
            </div>
            <div class="btn-group">
                <button @click="removePreOrder(id)" class="btn text-danger rounded material-symbols-outlined">
                    delete
                </button>
            </div>
        </li>
    </ul>
    <div class="d-flex justify-content-between">
        <div class="col-md-6 mt-3">
            <p class="m-0 text-muted"><small>
                Нажимая кнопку "Оформить предзаказ" вы соглашаетесь с нашей 
                <a href="/doc/privatepolice" target="_blank" class="text-muted">политикой конфиденциальности</a> и
                <a href="/doc/license" target="_blank" class="text-muted">пользовательским соглашением</a></small>
            </p>
        </div>
        <div class="d-flex justify-content-end gap-4 align-items-center mt-3 mb-5">
            <div class="py-2"></div>
            <div class="py-2 fw-bold pe-4"></div>
            <div class="py-2">@{{preamount}} (шт.)</div>
            <form action="/api/precheckout" method="post">
                <input type="hidden" name="_token" value="<?=csrf_token();?>" />
                <input type="hidden" name="name" :value="JSON.stringify(precheckout)" />
                <button v-on:click="preCheckout('<?=$user->verified?>')" class="btn btn-dark px-4 d-flex align-items-center gap-2 justify-content-center">
                    <span class="material-symbols-outlined" v-if="precheckout.length === 0">check</span>
                    <span class="material-symbols-outlined spin" v-else>autorenew</span>
                    @{{precheckout.length !== 0 ? 'Отправляем...' : 'Оформить предзаказ'}}
                </button>
            </form>
            @error('error')
                <label class="text-danger">{{ $message }}</label>
            @enderror   
        </div>
    </div>    
    @{{totalPreAmount}}
</template>
@endif
<?php /*
<pre>@{{JSON.stringify(precheckout, null, 4)}}</pre>
*/ ?>

@endsection