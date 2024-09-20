@extends('layout/main')
@section('title', 'Договоры')

@section('content')
<?php // =hexdec('FFB533');?>
<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="table-responsive rounded-top">
                <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                    <thead class="border-bottom border-light bg-light" style="font-size: 14px">
                        <tr>
                            <th class="w-60px ps-3">
                                <div class="text-muted mb-0">#</div>
                            </th> 
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="d-block text-muted text-decoration-none" 
                                    style="width: 120px;"
                                >
                                    № Договора &#160;<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="d-block text-muted text-decoration-none" 
                                    style="width: 70px;"
                                >
                                    ИНН &#160;<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="d-block text-muted text-decoration-none" 
                                    style="width: 210px;"
                                >
                                    Компания &#160;<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="d-block text-muted text-decoration-none" 
                                    style="width: 140px;"
                                >
                                    Статус договора &#160;<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="d-block text-muted text-decoration-none" 
                                    style="width: 140px"
                                    title="Дата заключения договора"
                                >
                                    Дата заключения &#160;<span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a 
                                    href="javascript: void(0);" 
                                    data-sort="name" 
                                    class="d-block text-muted text-decoration-none" 
                                    style="width: 148px"
                                >
                                    Телефон &#160;<span class="list-sort"></span>
                                </a>
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
                                @if(empty($item['state']))
                                <span class="d-flex align-items-center" style="cursor: not-allowed">
                                    <x-icon-emergency-home size="15px" color="#f00" />
                                    <a href="/dashboard/contract/pt/{{$item['id']}}/file.pdf" target="_blank" class="text-danger" style="cursor: not-allowed">
                                        {{$item['name']}}
                                    <a>                                    
                                </span>
                                @else
                                <a href="/dashboard/contract/pt/{{$item['id']}}/file.pdf" target="_blank" class="text-dark">
                                    {{$item['name']}}
                                </a>
                                @endif
                            </td>
                            <td>
                                <div>{{$item['agent']['inn']}}</div>
                            </td>
                            <td>
                                <a href="/dashboard/admin/contract/{{$item['id']}}" class="text-dark text-decoration-none">
                                    <strong>{{$item['agent']['name']}}</strong>
                                </a>
                            </td>
                            <td>
                                {{-- if ($item['id_card'] === 'z' || $item['id_card'] === 0)
                                    <x-badge color="40931" text="На рассмотрении" />
                                elseif ($item['id_card'] === 2)
                                    <x-badge color="danger" text="Заблокирован" /> 
                                else
                                    <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />
                                endif --}}
                                @if(isset($item['state']))
                                    <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />
                                @else
                                    <x-badge color="16758067" text="На рассмотрении" />
                                @endif
                                
                            </td> 
                            <td>
                                <small>
                                    {{date('d/m/Y, H:i', strtotime($item['moment']))}}
                                </small>
                            </td>
                            <td>
                                @if (isset($item['agent']['phone']))
                                    {!! $contact::getPhone($item['agent']['phone'], ['text-dark', 'text-decoration-none']) !!}
                                @else
                                    <span class="badge bg-secondary">Не указан</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection