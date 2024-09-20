@extends('layout/main')
@section('title', 'Мои предзаказы')


@section('content')
<h6 class="text-muted">Всего {!!$decl::preorders($order['count'])!!}</h6>
@if($order['rows'] !== null)
<div class="row mt-4">
    <div class="col">
        <div class="card border-0 w-100 rounded shadow-sm">
            <div class="card-header border-0 bg-white">...</div>
            <div class="table-responsive rounded-top">
                <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                    <thead class="border-bottom border-light bg-white" style="font-size: 14px">
                        <tr class="bg-light">
                            <th class="w-60px ps-3">
                                <div class="text-muted mb-0">#</div>
                            </th>
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="text-muted text-decoration-none" 
                                    style="display: block"
                                >
                                    Название <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" data-sort="status" class="text-muted text-decoration-none" style="width: 120px;display: block;">
                                    Дата создания<span class="list-sort"></span>
                                </a>
                            </th>                            
                            <th>
                                <a href="javascript: void(0);" data-sort="status" class="text-muted text-decoration-none" style="width: 90px;display: block;">
                                    Цена<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" data-sort="status" class="text-muted text-decoration-none" style="width: 90px;display: block;">
                                    НДС<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" data-sort="status" class="text-muted text-decoration-none" style="width: 90px;display: block;">
                                    Кол-во<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" data-sort="status" class="text-muted text-decoration-none" style="width: 90px;display: block;">
                                    Статус<span class="list-sort"></span>
                                </a>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="list" style="font-size: 14px">
                        @foreach($order['rows'] as $item)
                        <tr class="align-middle cp" onclick="getStartLink(`/dashboard/payment/preorder/{{$item['id']}}`)">
                            <td class="ps-3">{{$loop->iteration}}</td>
                            <td>
                                <span class="fw-bold text-dark">
                                    #{{$item['name']}}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{$time::parse($item['created'])->locale('ru')->translatedFormat('d M. Y / H:i')}}
                                </small>
                            </td>                            
                            <td>
                                <small>
                                    @php echo number_format(($item['sum']) / 100, 2, '.', ' ') @endphp ₽
                                </small>
                            </td>
                            <td>
                                <small>
                                    @php echo number_format(($item['vatSum']) / 100, 2, '.', ' ') @endphp ₽
                                </small>
                            </td>
                            <td>
                                {!! $decl::positions($item['size']) !!}
                            </td>
                            <td>
                                <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}"/>
                            </td>
                            <td>
                                <x-button 
                                    type="a" 
                                    href="/dashboard/payment/preorder/{{$item['id']}}"
                                    size="sm"
                                    icon="arrow_right_alt" 
                                    color="secondary" 
                                    text="Подробнее" 
                                />  
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
<pre><?php //var_dump($order);?></pre>
@endsection