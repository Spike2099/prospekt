@extends('layout/main')
@section('title', 'Отчёты')

@section('content')
<h6 class="text-muted">Всего {{$demand['count']}} {{$decl::demand($demand['count'])}}</h6>
@if(session('pdf'))
    <div id="upd_download" class="d-none">{{ session('pdf') }}</div>
@endif
@error('error')
    <x-alert type="danger" close="false" message="{{ $message }}" />
@enderror 
<div class="row mt-2">
    <div class="col-md-12">
        <div class="card bg-white border-0 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
                <div>...</div>
                <div>...</div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead class="bg-light">
                        <tr style="font-size: 13px">
                            <th scope="col" class="text-muted ps-4">#</th>
                            <th scope="col" class="text-muted">Заказ</th>
                            <th scope="col" class="text-muted">Кол-во</th>
                            <th scope="col" class="text-muted">Дата</th>
                            <th scope="col" class="text-muted">Сумма</th>
                            <th scope="col" class="text-muted">Оплачено</th>
                            <th scope="col" class="text-muted">Статус</th>
                            <th scope="col" class="text-muted"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demand['rows'] as $item)
                        <tr class="align-middle">
                            <td class="ps-4">{{$loop->iteration}}</td>
                            <td>
                                <a href="record/{{$item['id']}}" class="fw-bold text-dark text-decoration-none">
                                    #{{$item['name']}}
                                </a>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {!!$decl::positions($item['positions'])!!}
                                </small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{$time::parse($item['created'])->locale('ru')->translatedFormat('d M. Y / H:i')}}
                                </small>
                            </td>
                            <td>
                                {!!$currency::summa($item['sum'])!!}
                            </td>
                            <td>

                                <small class="@if($item['payedSum'] == 0) text-danger @endif">
                                    @php echo number_format(($item['payedSum']) / 100, 2, '.', ' ') @endphp ₽
                                </small>
                            </td>
                            <td>
                                <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />
                            </td>
                            <td class="d-flex flex-row-reverse pe-4">
                                @if($item['state']['name'] === 'Не оплачено')
                                    <x-button 
                                        size="sm"
                                        type="button" 
                                        color="success" 
                                        text="Оплатить" 
                                        icon="credit_card" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#manager" 
                                    />
                                @else
                                <form action="/dashboard/upd/pdf/export" method="post">
                                    @csrf
                                    <input type="hidden" name="name" value="{{$item['id']}}" />
                                    <x-button 
                                        size="sm"
                                        type="submit" 
                                        color="dark" 
                                        text="Скачать УПД" 
                                        icon="download"
                                    />
                                </form>
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