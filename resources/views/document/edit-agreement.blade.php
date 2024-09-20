@extends('layout/main')
@section('title', 'Редактируем договор')

@section('content')
<div class="card shadow-sm border-0">
    <form action="/dashboard/agreements/update" class="card-body" method="post">
        @csrf
        <div class="mt-2">
            <label class="fw-bold">Ваше Ф.И.О.</label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ $contract->name }}"
                placeholder="Ваше Ф.И.О." 
            />
            @error('name')
                <small class="valid-feedback d-block text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-2">
            <label class="fw-bold">Действуете на основании:</label>
            <select 
                name="action" 
                class="form-control @error('action') is-invalid @enderror"
            >
                <option value="" selected disabled>Действуете на основании...</option>
                @foreach (['устава', 'договоренности и устава', 'учредительного договора'] as $value)
                <option value="{{ $value }}" @if ($value == $contract->action) selected @endif >{{ $value }}</option>
                @endforeach
            </select>
            @error('action')
                <small class="valid-feedback d-block text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mt-2">
                    <label class="fw-bold">Банк:</label>
                    <input 
                        type="text" 
                        name="bank" 
                        class="form-control @error('bank') is-invalid @enderror" 
                        value="{{ $contract->bank }}"
                        placeholder="Наименование Банка" 
                    />
                    @error('bank')
                        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mt-2">
                    <label class="fw-bold">р/с:</label>
                    <input 
                        type="text" 
                        name="rs" 
                        class="form-control @error('rs') is-invalid @enderror" 
                        value="{{ $contract->rs }}"
                        placeholder="Рассчётный счёт (номер)" 
                    />
                    @error('rs')
                        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mt-2">
                    <label class="fw-bold">БИК:</label>
                    <input 
                        type="text" 
                        name="bik" 
                        class="form-control @error('bik') is-invalid @enderror" 
                        value="{{ $contract->bik }}"
                        placeholder="БИК (номер)" 
                    />
                    @error('bik')
                        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mt-2">
                    <label class="fw-bold">к/с:</label>
                    <input 
                        type="text" 
                        name="ks" 
                        class="form-control @error('ks') is-invalid @enderror" 
                        value="{{ $contract->ks }}"
                        placeholder="корр.счёт (номер)" 
                    />
                    @error('ks')
                        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="mt-2">
                    <label class="fw-bold">Телефон: ( без пробелов и скобок )</label>
                    <input 
                        type="text" 
                        name="phone" 
                        class="form-control input-phone @error('phone') is-invalid @enderror" 
                        v-on:click="addMaskPhone()"
                        value="{{ $contract->phone }}"
                        placeholder="Контактный номер телефона" 
                    />
                    @error('phone')
                        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mt-2">
                    <label class="fw-bold">E-mail:</label>
                    <input 
                        type="text" 
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ $contract->email }}"
                        placeholder="Контактный E-mail (корпоративный)" 
                    />
                    @error('email')
                        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mt-4">
            <x-button icon="check" color="dark" type="submit" text="Применить" />
        </div>
    </form>   
</div>
@endsection