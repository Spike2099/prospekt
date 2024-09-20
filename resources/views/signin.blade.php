@extends('layout/auth')

@section('title', 'Авторизация')

@section('content')
@include('layout.main.logo')

@if(session('status'))
    <x-alert type="success" close="false" message="{{ session('status') }}" />
@endif
@if(session('signup'))
    <x-alert type="success" close="false" message="{{ session('signup') }}" />
@endif
@if(session('error'))
    <x-alert type="danger" close="false" message="{{ session('error') }}" />
@endif

<form action="/login" method="post" class="mt-4">
    @csrf
    <div class="mt-2">
        <div class="input-group">
            <span class="input-group-text border-end-0 bg-white @error('email') border-danger @enderror">
                <x-icon-person color="#777" />
            </span>
            <input 
                type="text" 
                name="email" 
                v-model="mail"
                @change="cookieStart"
                class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" 
                value="{{ old('email') }}"
                placeholder="Ваш логин" 
            />
        </div>
        @error('email')
            <small class="valid-feedback d-block text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mt-2">
        <div class="input-group">
            <span class="input-group-text border-end-0 bg-white @error('password') border-danger @enderror">
                <x-icon-lock color="#777" />
            </span>
            <input 
                type="password" 
                name="password" 
                class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                value="{{ old('password') }}"
                placeholder="Ваш пароль" 
            />                
        </div>
        @error('password')
            <small class="valid-feedback d-block text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mt-2 d-grid">
        <x-button id="loading" color="danger" type="submit" text="Войти" />
    </div>
</form>
<div id="account" class="d-none">@if(session('id')) {{ session('id') }} @endif</div>
<div class="w-100 mt-2 text-center">
    <p class="d-grid mb-3">
        <a href="/forgot-password" class="btn btn-light text-dark">
            Восстановить пароль
        </a>
    </p>
    <p>
        <a href="/signup" class="text-dark">
            Зарегистрироваться
        </a>
    </p>
</div>
@endsection