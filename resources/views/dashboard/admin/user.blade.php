@extends('layout/main')
@section('title', 'Подробнее о пользователе')
@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <a href="/dashboard/admin/users" class="text-muted">
        Пользователи
    </a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">{{count($model) === 0 ? 'Договор не подписан' : $model[0]['company']}}</span>    
</div>
@endsection
@section('content')  
<h6 class="text-muted">ID: (МойСклад) {{$uuid}}</h6>
<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if(count($model) === 0)
                    Договор не подписан <a href="https://api.moysklad.ru/app/#Company/edit?id={{$uuid}}" target="_blank">Подробнее</a>
                @else
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td><strong>Ф.И.О. директора</strong></td>
                            <td>{{$model[0]['name']}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>E-mail:</strong></td>
                            <td onclick="alert('E-mail письма пока отправить нельзя')">{!!$contact::getEmail($model[0]['email'])!!}</td> 
                            <td>
                                @if ($model[0]['email_verified_at'] === null)
                                    <b class="text-danger d-flex gap-1 align-items-center">
                                        <span class="material-symbols-outlined">emergency_home</span> 
                                        <small>Не подтверждён</small> 
                                    </b>
                                @else
                                    <b class="text-success d-flex gap-1 align-items-center">
                                        <span class="material-symbols-outlined">verified_user</span> 
                                        <small>Подтверждён</small> 
                                    </b>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Дата создания аккаунта:</strong></td>
                            <td>
                                {{$timer::datatime($model[0]['created_at'])}}
                            </td>
                            <td>{{$timer::difference($model[0]['created_at'])}}</td>
                        </tr>
                        <tr>
                            <td><strong>Статус клиента:</strong></td>
                            <td>
                                @if ($model[0]['id_card'] === 'z' || $model[0]['id_card'] === 0)
                                    <x-badge color="40931" text="На рассмотрении" />
                                @elseif ($model[0]['id_card'] === 2)
                                    <x-badge color="danger" text="Заблокирован" /> 
                                @else
                                    <x-badge color="34617" text="Активирован" />  
                                @endif
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="" selected disabled>Выбрать статус...</option>
                                    <option value="0">На рассмотрение</option>
                                    <option value="2">Заблокировать</option>
                                    <option value="1">Активировать</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Название компании:</strong></td>
                            <td>{{$model[0]['company']}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>ОКВЭД:</strong></td>
                            <td><a href="/dashboard/admin/users/okved/{{$model[0]['okved']}}">{{$model[0]['okved']}}</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>ИНН:</strong></td>
                            <td>{{$model[0]['inn']}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>ОГРН:</strong></td>
                            <td>{{$model[0]['ogrn']}}</td>
                            <td>
                                <div class="d-flex gap-1 align-items-center text-muted">
                                    <span class="material-symbols-outlined fs-5">calendar_month</span>
                                    {{date('d.m.Y', $model[0]['ogrn_date'])}} г.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>КПП:</strong></td>
                            <td>{{$model[0]['kpp']}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>Юридический адрес:</strong></td>
                            <td>
                                <a href="https://www.google.ru/maps/place/{{urlencode($model[0]['address'])}}" target="_blank" rel="noopener noreferrer">
                                    {{$model[0]['address']}}
                                </a>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h3 class="font-weight-bold">Карточка организации</h3>
                <p class="m-0 text-muted">Реквизиты, контакты, сведения из ФНС</p>
            </div>
            <div class="card-footer border-top border-light-subtle bg-white d-flex gap-2">
                <a 
                    target="_blank"
                    class="btn btn-dark px-4 icon-link"
                    href="/dashboard/organization/{{$uuid}}/download.pdf"
                >
                    <x-icon-download />
                    Скачать
                </a>
                <a 
                    target="_blank"
                    class="btn bg-dark-subtle px-4 icon-link"
                    href="/dashboard/organization/{{$uuid}}/file.pdf"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                    Посмотреть
                </a>
                <i class="bi bi-android2"></i>
            </div>
        </div>
    </div>
</div>
@endsection