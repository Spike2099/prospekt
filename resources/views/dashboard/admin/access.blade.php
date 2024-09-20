@extends('layout/main')
@section('title', 'Права и роли')

@section('content')
<h6 class="text-muted">Права выдаются администратором при выборе пользователя.</h6>
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
                                Компания&#160;<span class="list-sort"></span>
                            </th>                            
                            <th>
                                ИНН&#160;<span class="list-sort"></span>
                            </th>
                            <th>
                                Роль&#160;<span class="list-sort"></span>
                            </th>
                            <th>
                                E-mail&#160;<span class="list-sort"></span>
                            </th>
                            <th>
                                Дата создания&#160;<span class="list-sort"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" style="font-size: 14px">
                        @foreach ($model as $role)
                        <tr>
                            <td>
                                <div class="ms-2">{{$loop->iteration}}</div>
                            </td>
                            <td>
                                <strong>{{$role['company']}}</strong> 
                            </td>                            
                            <td>
                                <a href="../admin/access/{{$role['uuid']}}" class="text-dark text-decoration-none">
                                    {{$role['inn']}}
                                </a>
                            </td>

                            <td>
                                @if ($role['slug'] === 'admin')
                                    <x-badge color="34617" text="Администратор" />
                                @else
                                    <x-badge color="40931" text="Покупатель" />  
                                @endif
                            </td>
                            <td onclick="alert('E-mail письма пока отправить нельзя')">
                                {!!$contact::getEmail($role['email'], ['text-dark'])!!}
                            </td> 
                            <td>
                                <small>
                                    {{$timer::datatime($role['created_at'])}}
                                    {{-- {{date('d F Y, H:i', strtotime($role['created_at']))}} --}}
                                </small>
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