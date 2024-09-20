@extends('layout/main')
@section('title', 'Номер ГТД')
@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <a href="/dashboard/admin/nomenclature" class="text-muted">
        Номенклатура
    </a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">ГТД {{$model['Code']}}</span>    
</div>
@endsection
@section('content')  
<pre><?php var_dump($model);?></pre>
@endsection