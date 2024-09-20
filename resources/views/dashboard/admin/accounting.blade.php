@extends('layout/main')
@section('title', 'Бухгалтерия')

@section('content')
    <h6 class="text-muted">Всего {{$decl::orders($receipt['count'])}}</h6>
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white fw-bold">
            Список счётов:
        </div>
        <div class="table-responsive">
        <table class="table table-hover m-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="text-muted ps-4">№</th>
                    <th scope="col" class="text-muted">
                        <small class="d-block" style="width: 310px">Контрагент</small> 
                    </th>
                    <th scope="col" class="text-muted">
                        <small style="display: block;width: 120px">Сумма Платежа</small> 
                    </th>
                    <th scope="col" class="text-muted">
                        <small style="display: block;width: 163px">Сумма Взаиморасчетов</small> 
                    </th>
                    <th scope="col" class="text-muted">
                        <small style="display: block;width: 120px">Сумма НДС</small> 
                    </th>                    
                    <th scope="col" class="text-muted">
                        <small style="display: block;width: 100px">НДС</small> 
                    </th>
                    <th scope="col" class="text-muted text-center">
                        <small>Возврат</small> 
                    </th>
                    <th scope="col" class="text-muted pe-4">
                        <small class="d-block" style="width: 256px">Способ Погашения Задолженности</small>
                    </th>                    
                </tr>
            </thead>
            <tbody>
            @foreach ($receipt['value'] as $item)
            <tr class="align-middle cp" onclick="getStartLink(`/dashboard/admin/accounting/details/{{$item['id']}}`)">
                <td class="ps-4">{{$loop->iteration}})</td>
                <td>{{$item['org']['name']}}</td>
                <td>{!! $currency::value($item['pay']) !!}</td>
                <td>{!! $currency::value($item['return_pay']) !!}</td>
                <td>{!! $currency::value($item['sum_tax']) !!}</td>
                <td>
                    <small class="text-muted">
                        {{$contact::format_nds($item['tax'])}}
                    </small>
                </td>
                <td class="text-center">{!! $currency::value($item['return_sum']) !!}</td>
                <td class="text-start">
                    @if ($item['status'] === '')
                        <x-badge color="danger" text="нет данных" />
                    @elseif ($item['status'] == 'Автоматически')
                        <x-badge color="40931" text="{{$contact::format_spz($item['status'])}}" />
                    @else
                        <x-badge color="34617" text="{{$contact::format_spz($item['status'])}}" />
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <pre><?php var_dump($receipt);?></pre>
    {{-- ДоговорКонтрагента@navigationLinkUrl
    СчетНаОплату@navigationLinkUrl
    СтатьяДвиженияДенежныхСредств@navigationLinkUrl
    СчетУчетаРасчетовСКонтрагентом@navigationLinkUrl
    СчетУчетаРасчетовПоАвансам@navigationLinkUrl --}}
@endsection