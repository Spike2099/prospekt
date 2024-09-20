@extends('layout/main')
@section('title', 'Пользователи')

@section('content')
<h6 class="text-muted">Всего {{$model['meta']['size']}}</h6>
<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="table-responsive rounded-top">
                <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                    <thead class="border-bottom border-light bg-light-subtle" style="font-size: 14px">
                        <tr>
                            <th class="w-60px ps-3">
                                <div class="text-muted mb-0">#</div>
                            </th> 
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 210px">
                                    Название компании&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 88px">
                                    ИНН&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void();" class="text-muted text-decoration-none d-block" style="width: 200px">
                                    E-mail&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 135px">
                                    Дата создания&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 100px">
                                    Статус&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th class="d-flex align-items-center gap-2 text-center border-0" style="height: 40px">
                                Опции
                                <span class="material-symbols-outlined fs-6 text-secondary">settings</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" style="font-size: 14px">
                        @foreach ($model['rows'] as $item)
                        <tr>
                            <td>
                                <div class="ms-2">{{$loop->iteration}}</div>
                            </td> 
                            <td>
                                <a 
                                    href="/dashboard/admin/user/{{$item['id']}}" 
                                    class="text-dark text-decoration-none fw-bold text-truncate d-block" 
                                    style="width:200px"
                                    title="{{$item['name']}}"
                                >
                                    {{$item['name']}}
                                </a>
                            </td>
                            <td>
                                @if (isset($item['inn']))
                                    {{$item['inn']}}
                                @else
                                    <span class="badge bg-light text-muted">Нет данных</span>
                                @endif
                            </td> 
                            @if (isset($item['email']))
                                <td onclick="alert('E-mail письма пока отправить нельзя')">
                                    {!!$contact::getEmail($item['email'], ['text-dark'])!!}
                                </td>                                 
                            @else
                                <td><span class="badge bg-light text-muted">Нет данных</span></td>
                            @endif
                            <td>
                                <small class="text-muted d-flex gap-1">
                                    <span class="material-symbols-outlined fs-6">calendar_month</span>
                                    {{date('d/m/Y, H:i', strtotime($item['created']))}}
                                </small>
                            </td>
                            <td>
                                {{-- if ($item['id_card'] === 'z' || $item['id_card'] === 0)
                                    <x-badge color="40931" text="На рассмотрении" />
                                elseif ($item['id_card'] === 2)
                                    <x-badge color="danger" text="Заблокирован" /> 
                                else
                                    <x-badge color="34617" text="Активирован" />  
                                endif --}}
                                <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="/dashboard/admin/user/{{$item['id']}}" class="btn btn-sm material-symbols-outlined">visibility</a>
                                    <form action="/dashboard/agent/delete/{{$model['id']}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm material-symbols-outlined text-danger">delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>                            
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{-- <pre><?php //var_dump($model);?></pre> --}}
        </div>          
    </div>
</div>

@endsection