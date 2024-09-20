@extends('layout/main')
@section('title', 'Пользователи')

@section('content')
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
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 210px">
                                    Ф.И.О. пользователя&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 170px">
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
                            <th class="d-flex justify-content-end gap-1">
                                <span class="d-flex align-items-center gap-2 text-muted me-2">
                                    Управление
                                    <span class="material-symbols-outlined fs-6 text-muted">settings</span>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" style="font-size: 14px">
                        @foreach ($model as $item)
                        <tr>
                            <td>
                                <div class="ms-2">{{$loop->iteration}}</div>
                            </td>
                            <td>
                                <a href="/dashboard/admin/user/{{$item['verified']}}" class="text-danger text-decoration-none fw-bold">
                                    {{$item['name']}}
                                </a>
                            </td> 
                            <td onclick="alert('E-mail письма пока отправить нельзя')">
                                {!!$contact::getEmail($item['email'], ['text-dark'])!!}
                            </td>
                            <td>
                                <small>
                                    {{date('d/m/Y, H:i', strtotime($item['created_at']))}}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="#" class="btn btn-sm material-symbols-outlined">visibility</a>
                                    <a href="#" class="btn btn-sm material-symbols-outlined">edit_note</a>
                                    <a href="#" class="btn btn-sm material-symbols-outlined text-danger">delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- <pre><?php //var_dump($model);?></pre> --}}
@endsection