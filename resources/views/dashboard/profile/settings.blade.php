@extends('layout/main')
@section('title', 'Настройки')

@section('content')


@if (session('status'))
    <x-alert type="success" message="{{ session('status') }}" close="true" />
@elseif (session('message'))
    <x-alert type="success" message="{{ session('message') }}" close="true" />
@endif


<div class="w-100 pb-5 pt-2 d-block">
    <ul class="nav nav-tabs border-0 nav-justified">
        <li class="nav-item">
            <button class="nav-link border-0 active fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane">
                Данные о компании
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link border-0 fw-bold" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane">
                Смена пароля
            </button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane rounded-bottom fade show active" id="home-tab-pane">
       
             <x-card icon="business_center" header="Покупатель: <b>{{ $profile['name'] ?? 'Name Not Found' }}</b>">

                <form action="/dashboard/settings" class="d-flex gap-3 flex-column" method="post">
                    @csrf
                   <input type="hidden" name="id" value="{{ $profile['id'] ?? '' }}" />
                    <div>
                        <label class="fw-bold">
                            Адрес компании <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="legalAddress" 
                            class="form-control @error('legalAddress') is-invalid @enderror" 
                             value="{{ isset($profile['legalAddress']) ? $profile['legalAddress'] : ''}}" 
                        />
                        @error('legalAddress')
                            <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label class="fw-bold">
                            Фактический адрес компании 
                            <span class="fw-light text-muted">(опционально)</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="actualAddress" 
                            value="{{ $profile['actualAddress'] ?? '' }}"


                        />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold">
                                E-mail <span class="fw-light text-muted">(фактический \ рабочий)</span> 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" 
                                placeholder="E-mail" 
                                value="{{$profile['email'] ?? '' }}"
                            />
                            @error('email')
                                <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">
                                Телефон <span class="fw-light text-muted">(фактический \ рабочий)</span> 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                name="phone" 
                                placeholder="Телефон" 
                                value="<?=isset($profile['phone']) ? $profile['phone'] : old('phone');?>"
                            />
                            @error('phone')
                                <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                            @enderror
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold">Способ получения <span class="fw-light text-muted">(опционально)</span></label>
                            <select v-model="address" v-on:change="onChange" class="form-control" name="delivery">
                                <option value="" disabled>Выберите способ получения...</option>
                                @foreach(['Доставка', 'Самовывоз'] as $item)
                                <option value="{{$item}}" 
                                    {{ ( isset($profile['actualAddressFull']['comment']) == $item ) ? 'selected' : '' }}
                                >{{$item}}</option>
                                @endforeach
                            </select>
                            <div class="form-text" v-if="address === 'Доставка'">
                                До транспортной компании 
                                <img src="/img/delivery/dostavka.png" style="width: 205px;height: 52px;margin-left: 10px;" alt="`СДЭК` / `Деловые линии`" />
                            </div>
                            <div class="d-flex gap-1 align-items-center form-text mt-3" v-else-if="address === 'Самовывоз'">
                                <span class="material-symbols-outlined text-danger">location_on</span>
                                <b>Адрес доставки:</b> 
                                г.Мытищи, МО, 4536-й проезд, стр. 10</div>
                            <div class="form-text" v-else></div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Контактное лицо <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('person') is-invalid @enderror" 
                                name="person" 
                                placeholder="Ваше имя и фамилия" 
                                value="<?=isset($profile['description']) ? $profile['description'] : old('person');?>" 
                            />
                            @error('person')
                                <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                            @enderror
                        </div>                         
                    </div>
                    <div class="border-top pt-3">
                        <x-button type="submit" color="dark" icon="done" text="Сохранить" />
                    </div>
                </form>
            </x-card>
        </div>

        <div class="tab-pane rounded-bottom fade" id="disabled-tab-pane">
            <x-card icon="lock_person" header="Смена пароля">
                <div>
                    <x-alert type="warning" message="Вам необходимо сменить пароль!" close="true" />
                    <x-alert type="danger" message="Новый пароль не должен совпадать со старым!" close="true" />
                    <x-alert type="info" header="Требования к паролю:" message="8 и более символов, хотя бы одна буква, хотя бы одна цифра" close="true" />                    
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3 py-4">
                        <form action="/confirm-reset-password" class="d-flex gap-3 flex-column" method="post">
                            @csrf
                            <div>
                                <div class="input-group">
                                    <span class="input-group-text material-symbols-outlined text-muted bg-white">
                                        lock_reset
                                    </span>
                                    <input 
                                        :type="[view_password ? 'text' : 'password']" 
                                        class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" 
                                        placeholder="Новый пароль" 
                                        name="password" 
                                    />
                                    <span class="material-symbols-outlined bg-white input-group-text cp text-secondary" @click="view_password = !view_password">
                                        visibility
                                    </span>
                                </div>
                                @error('password')
                                    <small class="valid-feedback d-block text-danger">{{ $message }}</small>
                                @enderror                                
                            </div>

                            <div>
                                <x-button type="submit" color="dark" icon="done" text="Сохранить" />
                            </div>
                        </form>                        
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
@endsection

