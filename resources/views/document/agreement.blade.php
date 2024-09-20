@extends('layout/main')
@section('title', isset($user->contract->name) ? 'Детали договора' : 'Заключение договора')

@section('content')

@if(session('status'))
    <x-alert type="success" close="true" message="{{ session('status') }}" />
@endif

@if(session('error'))
    <x-alert type="danger" close="true" message="{{ session('error') }}" />
@endif

<!-- isset($user->contract->name) -->
@if(isset($user->contract->name))
    @if(isset($contract))
    <div class="d-flex align-items-center gap-3 d-print-none">
        @if(isset($contract['state']['color']))
        <x-badge color="{{$contract['state']['color']}}" text="{{$contract['state']['name']}}" />
        @endif
        <span class="d-flex align-items-center gap-1 text-secondary">
            <span class="material-symbols-outlined fs-5">calendar_month</span>
            {{$timer::datatime($contract['updated'])}}
        </span>
    </div>
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body px-5 mt-5">
            @include('layout.contract.contract')
        </div>
    </div>
    @endif

    <p>{{--$user->status->id_card--}}</p> 
    @if($deal::status() === 'z')
    <div class="d-flex align-items-center row mt-4">
        <div class="col-12 col-lg-5 d-flex gap-3">
            <form action="/dashboard/action/deal" method="post">
                @csrf
                <x-button icon="done" color="dark" type="submit" text="Подтвердить" />
            </form>
            <x-button type="a" href="agreement/edit" icon="edit" color="outline-dark" text="Редактировать" />
        </div>
        <div class="col-12 col-lg-7">
            <div class="d-flex align-items-center gap-2 bg-soft-warning rounded p-3">
                <span class="material-symbols-outlined fs-1 text-warning">warning</span>
                <small class="text-muted lh-1">
                    Пожалуйста, внимательно ознакомьтесь с деталями договора. Если всё указано верное, нажмите кнопку "Подтвердить".
                    На данный момент вы всё ещё можете отредактировать данный договор.
                </small>                
            </div>
        </div>
    </div>
    @else
    <div class="d-flex align-items-center row mt-4 d-print-none">
        <div class="col-12 col-lg-6 d-flex gap-3">
            @if($deal::status() === '2')
            @else
            <x-button 
                type="a"
                color="dark"
                href="/dashboard/contract/download/pt/{{$contract['id']}}/file.pdf" 
                text="Распечатать" 
                icon="print" 
            /> 
            @endif
            <x-button 
                type="button"
                color="outline-dark"
                data-bs-toggle="modal" 
                data-bs-target="#manager"
                text="Связаться с менеджером" 
                icon="headset_mic" 
            />             
        </div>
        <div class="col-12 col-lg-6">
            @if($deal::status() === '2')
            @else
            <small class="text-muted">
                Распечатайте договор и подпишите в двух экземплярах, и отправьте на почту 
                {!!$contact::getEmail('info@prospekt-parts.com', ['text-muted'])!!}
                либо на адрес А\Я г. Мытищи, <br />
                <a href="https://astral.ru/products/astral-edo/" target="_blank" class="text-muted fw-bold" rel="noopener noreferrer">
                    ЭДО Калуга-Астрал
                </a>
            </small>
            @endif
        </div>
    </div>
    @endif

@else
    <div class="card shadow-sm border-0">
        <form action="/dashboard/agreements" class="card-body" method="post">
            @csrf
            <div class="mt-2">
                <label class="fw-bold">Ваше Ф.И.О.</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name') }}"
                    placeholder="Ваше Ф.И.О." 
                />
                @error('name')
                    <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="fw-bold">Действуете на основании:</label>
                <select name="action" class="form-control @error('action') is-invalid @enderror">
                    <option value="" selected disabled>Действуете на основании...</option>
                    @foreach (['устава', 'договоренности и устава', 'учредительного договора'] as $value)
                    <option value="{{ $value }}" @if ($value === old('action')) selected @endif>{{ $value }}</option>
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
                            value="{{ old('bank') }}"
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
                            value="{{ old('rs') }}"
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
                            value="{{ old('bik') }}"
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
                            value="{{ old('ks') }}"
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
                        <label class="fw-bold">Телефон:</label>
                        <input 
                            type="text" 
                            name="phone" 
                            v-on:click="addMaskPhone()"
                            class="form-control input-phone @error('phone') is-invalid @enderror" 
                            value="{{ old('phone') }}"
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
                            value="{{ old('email') }}"
                            placeholder="Контактный E-mail (корпоративный)" 
                        />
                        @error('email')
                            <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <x-button icon="drive_file_rename_outline" color="dark" type="submit" text="Заключить договор" />
            </div>
        </form>   
    </div>
@endif
<div class="modal fade" id="manager" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content border-0" novalidate @submit.prevent="SendManager('{{$user->verified}}')" v-if="!send">
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
@endsection