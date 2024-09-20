@extends('layout/auth')

@section('title')
@if (session('status')) Успешно @else Восстановление пароля @endif
@endsection

@section('content')
@include('layout.main.logo')
@if (session('status'))
    <div class="alert bg-white m-0 text-center px-0">
        {{ session('status') }}
        <br/>
        <small>{{session('text')}}</small>
    </div>
@else
    <form method="POST" action="/forgot-password" class="mt-3">
        @csrf
        <div class="mt-2">
            <input 
                type="text" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email') }}"
                placeholder="Ваш e-mail" 
            />
            @error('email')
                <small class="valid-feedback d-block text-danger">{{ $message }}</small>
            @enderror        
        </div>
        <div class="d-grid mt-2">
            <x-button id="loading" type="submit" color="danger" text="Восстановить пароль" icon="" />
        </div>
        <div class="text-center mt-2">
            <a href="/signin" class="text-dark">Назад</a>
        </div>
    </form>
@endif

@endsection