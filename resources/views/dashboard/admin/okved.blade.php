@extends('layout/main')
@section('title', 'ОКВЭД')
@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <a href="/dashboard/admin/users" class="text-muted">
        Пользователи
    </a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">{{$okved}}</span>    
</div>
@endsection
@section('content')  
<h6 class="text-muted">Информация о деятельности компании</h6>
<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($data !== NULL)
                <b>{{$data["suggestions"][0]["data"]["idx"]}}</b> - {{$data["suggestions"][0]["data"]["name"]}}
                @else
                <p class="text-danger">Нет данных, или номер ОКВЭД указан не верно</p> 
                @endif
                {{-- <pre><?php //var_dump($data["suggestions"][0]["data"]);?></pre> --}}
            </div>
        </div>
    </div>
</div>
@endsection