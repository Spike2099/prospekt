@extends('layout/auth')

@section('title', 'Восстановление пароля')

@section('content')
@include('layout.main.logo')
<form action="/reset" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="input-group mt-4">
        <input 
            type="text" 
            name="email" 
            placeholder="Введите ваш E-mail" 
            class="form-control @error('email')is-invalid @enderror d-none" 
            value="{{ $_GET['email'] }}"
        />
        <!-- <button class="btn btn-primary material-symbols-outlined">
            outgoing_mail
        </button> -->
    </div>
    @error('email')
        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
    @enderror
    <div class="mt-2">
        <input 
            type="password" 
            name="password"
            placeholder="Введите новый пароль" 
            class="form-control px-4 @error('password')is-invalid @enderror" 
        />    
        @error('password')
        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
        @enderror    
    </div>
    <div class="mt-2">
        <input 
            type="password" 
            name="password_confirmation"
            placeholder="Подтвердите пароль"
            class="form-control px-4 @error('password_confirmation')is-invalid @enderror"
        />
        @error('password_confirmation')
        <small class="valid-feedback d-block text-danger">{{ $message }}</small>
        @enderror  
    </div>
    <div class="d-grid mt-2">
        <x-button id="loading" color="danger" type="submit" text="Сменить пароль" icon="outgoing_mail" />
    </div>
</form>
<div class="w-100 mt-3 text-center">
    <a href="/">Назад</a>
</div>
@endsection