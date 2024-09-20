@extends('layout/main')
@section('title', 'Договор №'.$model['name'])

@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <a href="/dashboard/admin/contracts" class="text-muted">
        Договоры
    </a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">
        @if ($model['agent']['companyType'] === 'legal')
            Юридическое лицо
        @elseif ($model['agent']['companyType'] === 'entrepreneur')
            Индивидуальный предприниматель
        @else   
            Физическое лицо
        @endif
    </span>    
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <p>
            <x-badge 
                color="{{$model['agent']['state']['color']}}" 
                text="{{$model['agent']['state']['name']}}" 
            />
        </p>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="text-muted"><strong>Дата договора:</strong> {{$timer::datatime($model['agent']['created'])}}</p>
                    @if ($status === null)
                        <p>нет данных</p> 
                    @else
                        <template v-if="!loading"><p>Загрузка...</p></template>
                        <template v-if="active === 0">
                            @if ($status->id_card == '0')
                                <button class="btn btn-sm btn-dark" v-on:click="activeContract('{{$model['agent']['id']}}')">
                                    Активировать
                                </button>                                
                            @elseif ($status->id_card == '1')
                                <div>
                                    <x-badge color="34617" text="Активирован" />
                                    <button class="btn btn-sm btn-danger" v-on:click="blockContract('{{$model['agent']['id']}}')">
                                        Заблокировать
                                    </button>                                 
                                </div>
                            @elseif ($status->id_card == '2')
                                <div>
                                    <x-badge color="danger" text="Заблокирован" />
                                    <button class="btn btn-sm btn-dark" v-on:click="activeContract('{{$model['agent']['id']}}')">
                                        Активировать
                                    </button> 
                                </div>
                            @else
                            ---
                            @endif

                        </template>
                        <template v-else-if="active === 2">
                            <div>
                                <x-badge color="danger" text="Заблокирован" />
                            </div>
                        </template>
                        <template v-else>
                            <div>
                                <x-badge color="34617" text="Активирован" />
                            </div>
                        </template>
                    @endif  
                </div>

                <p><strong class="fs-4">{{$model['agent']['name']}}</strong></p>
                <p><strong>Юридический адрес:</strong>  {{$model['agent']['legalAddress'] ?? 'Нет данных'}} </p>
                <p><strong>Фактический адрес:</strong>  {{$model['agent']['actualAddress'] ?? 'Нет данных'}} </p>
                <p class="m-0"><strong>ИНН:</strong> {{$model['agent']['inn'] ?? 'Нет данных'}}</p>
                <p class="m-0"><strong>КПП:</strong> {{$model['agent']['kpp'] ?? 'Нет данных'}}</p>
                <p class="m-0"><strong>ОГРН:</strong> {{$model['agent']['ogrn'] ?? 'Нет данных'}}</p>
                <p class="m-0"><strong>ОКПО:</strong> {{$model['agent']['okpo'] ?? 'Нет данных'}}</p>
                
                {{-- <p>{{$status->id_card}} </p> --}}
                @if (isset($model['agent']['email']))
                    <hr />
                   <p><strong>E-mail:</strong> {!! $contact::getEmail($model['agent']['email'], []) !!}</p> 
                @endif
                @if (isset($model['agent']['phone']))
                    <p><strong>Телефон:</strong> {!! $contact::getPhone($model['agent']['phone'], []) !!}</p>
                @endif

                @if(count($model['agent']['accounts']['rows']) !== 0)
                    <div class="border p-3">
                        <p><strong>Реквизиты компании:</strong></p>
                        <p class="m-0">Номер счета: {{$model['agent']['accounts']['rows'][0]['accountNumber'] ?? 'Нет данных'}}</p>
                        <p class="m-0">БИК: {{$model['agent']['accounts']['rows'][0]['bic'] ?? 'Нет данных'}}</p>
                        <p class="m-0">Банк: {{$model['agent']['accounts']['rows'][0]['bankName'] ?? 'Нет данных'}}</p>
                        <p class="m-0">{{$model['agent']['accounts']['rows'][0]['bankLocation'] ?? 'Нет данных'}}</p>
                        <p class="m-0">К/с: {{$model['agent']['accounts']['rows'][0]['correspondentAccount'] ?? 'Нет данных'}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection