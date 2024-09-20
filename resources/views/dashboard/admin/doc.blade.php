@extends('layout/main')
@section('title', 'Заказы')

@section('content')
<pre><?php //var_dump($list);?></pre>
<select name="template" class="form-control">
    <option value="" selected disabled>Выберите шаблон</option>
    @foreach ($list['rows'] as $item)
        <option value="{{$item['id']}}">{{$item['name']}}</option>
    @endforeach
</select>
@endsection