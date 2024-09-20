@extends('layout/main')
@section('title', 'Детали:Права и роли')

@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <a href="/dashboard/admin/access" class="text-muted">
        Права и роли
    </a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">
        {{$id}}
    </span>    
</div>
@endsection

@section('content')
Детали
<p>{{$id}}</p>
@endsection